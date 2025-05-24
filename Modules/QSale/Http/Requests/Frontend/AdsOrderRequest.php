<?php

namespace Modules\QSale\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdsOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd(auth()->id());
        return  [
                        "addations"                => "required|array|min:0",
                        "addations.*"              =>  [
                            "required","exists:addations,id", Rule::unique("ads_addations", "addation_id")                                
                            ->where("ads_id", $this->id)
                        ]
                ] ;
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
