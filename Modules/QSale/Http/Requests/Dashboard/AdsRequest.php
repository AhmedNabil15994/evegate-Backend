<?php

namespace Modules\QSale\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use Modules\User\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule =  [
            "title"       => "required|max:255",
            "description" => "nullable",
            "mobile"      => "nullable",
            "status"        => "required",
            "hide_private_number" => "nullable",
            "price"             => "nullable|numeric|min:0|regex:/^\d{1,13}(\.\d{1,4})?$/",
            "image"             => "required|image",
            "attachs"           => "nullable|array",
            "attachs.*"         => "file",
            "sort"          => "nullable",
            "start_at"          => "nullable",
            "duration"          => "nullable|integer|min:0",
            "user_id"           => "required|exists:users,id",
            "category_id"       => "required|exists:categories,id",
            "ad_types"             => "nullable|array",
            "ad_types.*"           => "required|exists:ad_types,id",
            "user_type"            => "nullable|in:" . implode(",", UserType::getConstList())
        ];


        $rule = array_merge(
            $rule,
            $this->validationAddations()
        );

        if (strtolower($this->getMethod()) == "put") {
            $rule["image"] = "nullable|image";
            $rule["start_at"] = "required|date";
            $rule["end_at"]  = "required|after_or_equal:start_at";
            $rule["ads_price"] = "required|numeric|min:0";
            unset($rule["duration"], $rule["user_id"], $rule["user_type"]);
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

    public function validationAttraibute()
    {
        return [
            "adsAttributes.*"               => "nullable|array",
            "adsAttributes.*.attribute_id"    => [
                "sometimes",
                Rule::exists("category_attributes", "attribute_id")
                    ->where("category_id", $this->category_id)
            ],
            "adsAttributes.*.option_id"       => [
                "sometimes",
                Rule::exists("options", "id")
                    ->where("attribute_id", $this->input("adsAttributes.*.attribute_id"))
            ],
            "adsAttributes.*.value"           => "sometimes"
        ];
    }

    public function validationAddations()
    {
        return [
            "addations.*"               => "nullable|exists:addations,id",
        ];
    }
}
