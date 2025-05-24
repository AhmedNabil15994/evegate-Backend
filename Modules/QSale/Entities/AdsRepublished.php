<?php

namespace Modules\QSale\Entities;

use Modules\Core\Traits\UsesUuid;
use Modules\QSale\Enum\AdsStatus;
use Modules\QSale\Entities\Payment;
use Illuminate\Database\Eloquent\Model;

class AdsRepublished extends Model
{
    use UsesUuid;
    protected $guarded = ["id"];

    public function ads()
    {
        return $this->belongsTo(Ads::class, "ads_id");
    }

    public function republishedPackage()
    {
        return $this->belongsTo(RepublishedPackage::class, "republished_package_id");
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, "order");
    }

    public function confirm($ads = null)
    {
        $now = now();
        $end = $now->copy()->addDays($this->duration);

        $ads = $ads ??  $this->ads;

        $this->update([
            "is_paid"   => true ,
            "start_at"  => $now,
            "end_at"    =>  $end  ,
        ]);

        $ads->update([
            "is_paid"   => true ,
            "status"    => AdsStatus::PUBLIUSH,
            "start_at"  => $now,
            "end_at"    =>  $end  ,
        ]);
    }
}
