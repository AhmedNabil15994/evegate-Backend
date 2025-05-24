<?php

namespace Modules\QSale\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ClearsResponseCache;
use Modules\Core\Traits\HasCompositePrimaryKey;

class AdsAddation extends Model
{
    use HasCompositePrimaryKey;
    use  ClearsResponseCache;

    protected $guarded = ["id"];
    protected $primaryKey = ["ads_id", "addation_id"];
    protected $with = ["addation"];

    public function ads()
    {
        return $this->belongsTo(Ads::class, "ads_id");
    }

    public function addation()
    {
        return $this->belongsTo(Addation::class, "addation_id");
    }


    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->start_date = now();
            $model->expire_date = now()->addDays($model->addation->days);
            $model->save();
        });
    }
}
