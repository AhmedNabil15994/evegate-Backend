<?php

namespace Modules\QSale\Entities;

use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\CasscadeAttach;
use Spatie\Translatable\HasTranslations;
use Modules\Core\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addation extends Model
{

    use SoftDeletes, ScopesTrait, ClearsResponseCache;
    use HasTranslations, CasscadeAttach;

    public $translatable = ['description', "name"];
    protected $casscadeAttachs = ["icon"];

    protected $guarded = ["id"];

    public function ads()
    {
        return $this->belongsToMany(Ads::class, 'ads_addations', 'addation_id', "ads_id")
            ->withTimestamps();
    }


    public function getAds($request)
    {
        return $this->ads()->allowShow()
            ->with(["user", "media", "addations", "attributes", "category", "office", "address",/*"country", "city", "state"*/])
            ->take(8)->get();
    }
}
