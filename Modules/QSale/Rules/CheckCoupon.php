<?php

namespace Modules\QSale\Rules;

use Modules\QSale\Entities\Coupon;
use Modules\QSale\Entities\Package;
use Illuminate\Contracts\Validation\Rule;

class CheckCoupon implements Rule
{
    public $package_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($package_id)
    {

        $this->package_id = $package_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $package = Package::find($this->package_id);
        $coupon = Coupon::unExpired()->active()->notLimited()
            ->where("code", $value)->whereHas('packages', function ($query) {
                return $query->where('package_id', $this->package_id);
            })->first();
        if (!$coupon) return false;
        return $coupon->checkAllow($package->price);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("qsale::api.coupons.validation.not_validCoupon");
    }
}
