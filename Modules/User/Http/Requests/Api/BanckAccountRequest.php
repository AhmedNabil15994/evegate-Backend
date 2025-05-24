<?php

namespace Modules\User\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BanckAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            "user_name"      => "required|max:255",
            "bank_name"      => "required|max:255",
            "account_number" => "required|max:255",
            "address"        => "nullable|max:255",
            "iban"           => "required|max:255",

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
 