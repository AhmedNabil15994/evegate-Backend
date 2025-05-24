<?php

namespace Modules\QSale\Entities;

use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class SubscriptionHistory extends Model
{
    use UsesUuid;
    protected $guarded 				    	= ['id'];
    protected $casts = [
        'data' => 'array',
    ];

    public function package(){
        return $this->belongsTo(Package::class, "package_id");
    }

    public function Subscription(){
        return $this->belongsTo(Subscription::class, "subscription_id");
    }

    public function payment(){
        return $this->belongsTo(Payment::class, "payment_id");
    }
}
