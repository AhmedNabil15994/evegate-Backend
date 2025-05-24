<?php

namespace Modules\QSale\Entities;

use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ClearsResponseCache;
use Modules\Core\Traits\ScopesTrait;

class Subscription extends Model
{
    use UsesUuid;
    use ScopesTrait;
    use  ClearsResponseCache;
    protected $guarded = ['id'];

    protected $dates = [
        "renewal_at"
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, "package_id");
    }

    public function checkAvailable()
    {
        $now = now()->format("Y-m-d");
        return ($now >= $this->start_at && $now <= $this->end_at);
    }

    public function histories()
    {
        return $this->hasMany(SubscriptionHistory::class, "subscription_id");
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, "order")->where("status", "wait");
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, "order");
    }

    public function recordHistory($payment_id = null)
    {
        $this->histories()->create([
            "payment_id" => $payment_id,
            "data"       => $this->toArray(),
            "package_id" => $this->package_id,
        ]);
    }

    public function checkAllowUse()
    {
        return $this->checkAvailable() && $this->current_use < $this->max_use;
    }

    public function scopeAuthTenant($query)
    {
        $query->where("user_id", auth()->id());
    }


    public function confirm($payment = null)
    {
        $date = now();
        $package = $this->package;
        $is_renewal = !is_null($this->start_at);
        $data = [
            "is_paied"        => true,
            "is_free"         => $package->is_free,
            "is_default"      => true,
            "start_at"        => $date,
            "end_at"          => $date->copy()->addDays($package->duration),
            "money"           => $package->price,
            "max_use"         => $package->number_of_ads,
            "duration_of_ads" => $package->duration_of_ads,
            "current_use"     => 0,
        ];

        if ($is_renewal) {
            $data["renewal_count"] = $this->renewal_count + 1;
            $data["renewal_at"]    = now();
        }

        $this->update($data);

        self::where("user_id", $this->user_id)
            ->where("id", "!=", $this->id)
            ->update(["is_default" => 0]);

        $this->recordHistory(optional($payment)->id);
    }


    public function coupons()
    {
        return $this->hasMany(CouponSubscription::class, 'subscription_id');
    }
}
