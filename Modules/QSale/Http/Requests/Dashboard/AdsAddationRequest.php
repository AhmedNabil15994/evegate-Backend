<?php

namespace Modules\QSale\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdsAddationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "addation_id"              =>  [
                "required", "exists:addations,id", Rule::unique("ads_addations", "addation_id")
                    ->where("ads_id", $this->ads->id)
            ]
        ];

        if ($this->isMethod('PUT')) {
            $rules  = [
                "addations.*" => 'required|array',
                "addations.*start_date" => 'required|lt:expire_date',
                "addations.*expire_date" => 'required|gt:field',
            ];
        }

        return $rules;
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
