<?php

namespace Modules\Slider\Entities;

use Modules\QSale\Entities\Ads;
use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes, ScopesTrait;

    protected $table    = 'sliders';
    protected $fillable = ['image','link','status','start_at','end_at', "type", "info","ads_id", "position"];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'info' => "collection",
    ];

    public function ads()
    {
        return $this->belongsTo(Ads::class, "ads_id");
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, "slider_categories", "slider_id", "category_id")
                 ->withTimestamps();
    }
}
