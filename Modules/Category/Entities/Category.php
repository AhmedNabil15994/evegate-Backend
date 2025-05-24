<?php

namespace Modules\Category\Entities;

use Kalnoy\Nestedset\NodeTrait;
use Modules\Area\Entities\Country;
use Modules\QSale\Entities\Ads;
use Modules\User\Entities\User;
use Modules\Vendor\Entities\Vendor;
use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Attribute\Entities\Attribute;
use Modules\Core\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Vendor\Entities\VendorCategories;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract
{
    use Translatable, SoftDeletes, ScopesTrait;
    use NodeTrait, ClearsResponseCache;


    protected $with = ['translations'];
    protected $fillable = [
        'status', 'image', 'parent_id', 'color', "price", "is_end_category", "slim_details", "type", "sort","country_id"
    ];

    public $translatedAttributes = ['title', 'slug', 'seo_description', 'seo_keywords'];
    public $translationModel      = CategoryTranslation::class;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }



    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'category_attributes',
            'category_id',
            "attribute_id"
        )
            ->withTimestamps();
    }

    public function attributesAllow()
    {
        return $this->attributes()->where("attributes.status", 1);
    }


    public function ads()
    {
        return $this->hasMany(Ads::class, "category_id");
    }

    public function country()
    {
        return $this->belongsTo(Country::class, "country_id");
    }


    // public function children()
    // {
    //     return $this->hasMany(Category::class, 'category_id');
    // }

    public function allChildren()
    {
        return $this->children()
            ->active()
            ->orderBy("sort", "asc")
            ->orderBy('id', 'DESC')
            ->with(['allChildren' => function ($query) {
                $query->active()
                    ->when(request()->has("with_attribute"), function ($query) {
                        $query->with("attributesAllow.optionsAllow");
                    })
                    ->orderBy("sort", "asc")
                    ->orderBy('id', 'DESC');
            }]);
    }


    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

    public function scopeBaseFilter($query, $request)
    {
        $with = [];

        if ($request->has("with_attribute")) {
            array_push($with, "attributesAllow.optionsAllow");
        }

        if ($request->has("with_child")) {
            if ($request->has("with_attribute")) {
                array_push($with, "allChildren.attributesAllow.optionsAllow");
            } else {
                array_push($with, "allChildren");
            }
        }

        $query->when($request->only_main, function ($category) {
            $category->mainCategories();
        });

        $query->when($request->search, function ($category)  use ($request) {
            $category->whereHas('translations', function ($query) use ($request) {
                $query->orWhere('title', 'like', '%' . $request->input('search.value') . '%');
                $query->orWhere('slug', 'like', '%' . $request->input('search.value') . '%');
            });
        });

        if ($request->type) {
            $query->where("type", $request->type);
        }

        $query->with($with);
    }

    public function getFirstLevel()
    {
        return $this->children()->active()
            ->get();
    }
}
