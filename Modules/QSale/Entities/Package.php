<?php

namespace Modules\QSale\Entities;

use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Modules\Core\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasTranslations,
        ScopesTrait,
        ClearsResponseCache,
        SoftDeletes;
    public $translatable = ['title', "description"];
    protected $guarded   = ['id'];
    public function getPriceAttribute($value)
    {
        if (request()->coupon && $coupon = Coupon::validCoupon(request()->coupon)->first()) {
            return (string)($value - $coupon->applyCoupon($value));
        }
        return $value;
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'package_id');
    }


    public function scopeCurrentSubscription($query, $request)
    {
        if ($request->user_id) {
            $query->with(
                [
                    "subscriptions" => fn ($q) => $q->where("subscriptions.user_id", $request->user_id)
                ]
            );
        }
    }

    public function coupons()
    {
        return $this->belongsToMany(
            Coupon::class,
            'coupon_packages',
            'package_id',
            "coupon_id",
        )->withTimestamps();
    }
}
