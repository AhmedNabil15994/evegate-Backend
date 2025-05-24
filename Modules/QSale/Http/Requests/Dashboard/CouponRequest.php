<?php

namespace Modules\QSale\Http\Requests\Dashboard;

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
        $rule =  [
            "code"       => "required|unique:coupons,id",
            "amount"     => "required",
            "min"        => "required|numeric|min:0",
            "max"        => "sometimes|numeric|min:" . $this->min,
            "max_use"    => "required|integer|min:1",
            "max_use_user"    => "required|integer|max:" . $this->max_use,
            "expired_at"     => "required|date|after_or_equal:today",
            "packages"     => "required|array",
            "packages.*"     => "required|exists:packages,id",
        ];
        if (strtolower($this->getMethod()) == "put") {
            $rule["expired_at"] = "required";
            $rule["code"]       =   $rule["code"] . "," . $this->id;
        }
        return $rule;
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
