<?php

namespace Modules\QSale\Entities;

use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class AdsOrder extends Model
{
    use UsesUuid;
    
    protected $guarded = ["id"];

    public function ads()
    {
        return $this->belongsTo(Ads::class, "ads_id");
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, "order");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function addations()
    {
        return $this->hasMany(AddationOrder::class, "ads_order_id");
    }

    public function confirm($ads)
    {

        foreach ($this->addations()->get(['price','addation_id','start_date','expire_date']) as $addation) {
            
            $ads->addations()->create($addation->toArray());
        }
        $this->update(["is_paid"=>1]);
        $ads->update(["addation_total" =>$this->total + $ads->total]);
    }
}
