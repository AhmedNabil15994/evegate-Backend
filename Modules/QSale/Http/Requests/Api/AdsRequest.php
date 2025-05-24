<?php

namespace Modules\QSale\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
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
            "title"               => "required|max:255",
            "description"         => "nullable",
            "size"                => "nullable",
            "mobile"              => "nullable|numeric",
            "hide_private_number" => "required|boolean",
            "price"               => "nullable",
            "image"               => "nullable|image",
            "video"               => "nullable|file",
            "attachs"             => "nullable|array",
            "attachs.*"           => "file",
            "category_id"         => "nullable|exists:categories,id",
            "country_id"         => "nullable|exists:countries,id",
            "ad_types"            => "nullable|array",
            "ad_types.*"          => "required|exists:ad_types,id",
            "offer_price"         => "nullable"
        ];


        return array_merge(
            $rule,
            $this->validationAttraibute(),
            $this->validationAddations(),
            $this->validationAddress(),
        );
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
                "required",
                Rule::exists("attributes", "id")
                // ->where("category_id", $this->category_id)
            ],
            "adsAttributes.*.option_id"       => [
                "sometimes",
                "nullable",
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

    private function validationAddress()
    {
        return [
            "address"              => "sometimes|nullable|array|min:0",
            "address.*.country_id" => "sometimes|nullable|exists:countries,id",
            "address.*.city_id"    => "sometimes|nullable|exists:cities,id",
            "address.*.state_id"   => "sometimes|nullable|exists:states,id",
        ];
    }
}
