<?php

namespace Modules\Offer\Entities;

use Spatie\MediaLibrary\HasMedia;
use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Core\Traits\CasscadeAttach;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations,
        CasscadeAttach,
        SoftDeletes,
        ScopesTrait;

    public $translatable = ['title', "description"];
    protected $guarded                         = ['id'];
    protected $casscadeAttachs = ["image"];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeCategoryFilter($query, $request)
    {

        if (is_numeric($request->category_id)) {

            $query->where(function ($base) use (&$request) {
                $base->where("category_id", $request->category_id)
                    ->when($request->withChildCategory, function ($childQuery) use (&$request) {
                        $childIds = Category::active()->descendantsOf($request->category_id)
                            ->toFlatTree($request->category_id)->pluck("id")->toArray();
                        if (count($childIds) > 0) {
                            $childQuery->OrWhereIn("category_id", $childIds);
                        }
                    });
            });
        }

        if (is_array($request->category_id)) {
            $query->where(function ($base) use (&$request) {
                $allCategories = [];
                foreach ($request->category_id as $id) {
                    $childIds = Category::active()->descendantsOf($id)
                        ->toFlatTree($id)->pluck("id")->toArray();
                    array_push($childIds, (int)$id);
                    $allCategories = array_merge($allCategories, $childIds);
                }
                $base->whereIn("category_id", $allCategories);
            });
        }

        return $query;
    }
}
