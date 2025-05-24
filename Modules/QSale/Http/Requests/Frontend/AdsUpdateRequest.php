<?php

namespace Modules\QSale\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdsUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule=  [
            "title"       => "required|max:255",
            "description" => "nullable",
            "mobile"      => "nullable",
            "hide_private_number"=> "sometimes|boolean",
            "price"                => "nullable|numeric|min:0",
            "image"                => "nullable|image",
            "attachs"              => "nullable|array",
            "attachs.*"            => "file",
            "category_id"          => "required|exists:categories,id" ,
            "address"              => "required|array",
            "address.*.country_id" => "nullable|exists:countries,id",
            "address.*.city_id"    => "nullable|exists:cities,id"    ,
            "address.*.state_id"   => "nullable|exists:states,id"    ,
            "deleteMedia"      => ["nullable", "array"],
            "deleteAddress"    => "nullable|array",
            "deleteAddress.*"  => "required|exists:ads_addresses,id",
            "ad_types"             => "nullable|array",
            "ad_types.*"           => "required|exists:ad_types,id",

        ];


        return array_merge(
            $rule,
            $this->validationAttraibute(),
            $this->validationAddations(),
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
            "adsAttributes.*"               => "nullable|array" ,
            "adsAttributes.*.attribute_id"    => ["sometimes",
                                                        Rule::exists("category_attributes", "attribute_id")
                                                            ->where("category_id", $this->category_id)
                                                 ],
            "adsAttributes.*.option_id"       => ["sometimes",
                                                        Rule::exists("options", "id")
                                                            ->where("attribute_id", $this->input("adsAttributes.*.attribute_id"))
                                                ] ,
            "adsAttributes.*.value"           => "sometimes"
        ];
    }

    public function validationAddations()
    {
        return [
            "addations.*"               => "nullable|exists:addations,id" ,
        ];
    }
}
