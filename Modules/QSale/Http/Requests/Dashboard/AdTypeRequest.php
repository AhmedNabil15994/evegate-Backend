<?php

namespace Modules\QSale\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AdTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"             => "required|array",
            "name.*"           => "required|string|max:255",
          
            "description.*"     => "nullable|string" ,

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
