<?php

namespace Modules\QSale\Entities;

use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class AddationOrder extends Model
{
    use UsesUuid;
    protected $guarded = ["id"];

    public function adsOrder(){
        return $this->belongsTo(AdsOrder::class, "ads__order_id");
    }

    public function addation(){
        return $this->belongsTo(Addation::class, "addation_id");
    }

}
