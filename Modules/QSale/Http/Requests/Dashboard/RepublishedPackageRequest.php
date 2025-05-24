<?php

namespace Modules\QSale\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class RepublishedPackageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title"             => "required|array",
            "title.*"           => "required|string|max:255",
            "price"             => "required_without:is_free|numeric|min:0",
            "duration"          => "required|integer|min:1",
            "description.*"     => "nullable|string"
 
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
