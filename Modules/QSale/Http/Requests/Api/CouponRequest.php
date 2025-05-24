<?php

namespace Modules\QSale\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Modules\QSale\Entities\Coupon;
use Modules\QSale\Entities\Package;
use Modules\QSale\Rules\CheckCoupon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return   [
            'package_id' => 'required|exists:packages,id',
            'code' => ['required', Rule::exists("coupons", "code"), new CheckCoupon($this->package_id)],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
