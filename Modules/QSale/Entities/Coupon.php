<?php

namespace Modules\QSale\Entities;

use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use UsesUuid;
    protected $guarded = ["id"];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeUnExpired($query)
    {
        $query->where('expired_at', '>', date('Y-m-d'));
    }

    public function scopeNotLimited($query)
    {
        $query->whereColumn('current_use', '<', "max_use");
    }

    public function checkAllow($price)
    {
        if ($this->min > $price) {
            return false;
        }
        return true;
    }

    public function applyCoupon($price)
    {
        $discount = $this->amount;

        if ($this->is_fixed) {
            return $discount;
        } else {
            $discount  = $price / $discount;
            $discount = $this->max > 0  && $this->max < $discount ? $this->max : $discount;
        }
        if ($this->min > $discount) return 0;
        return formatTotal($discount, 3);
    }

    public function scopeValidCoupon($query, $code)
    {
        return $query->unExpired()->active()->notLimited()
            ->where("code", $code);
    }


    public function packages()
    {
        return $this->belongsToMany(
            Package::class,
            'coupon_packages',
            "coupon_id",
            'package_id',
        )->withTimestamps();
    }
}
