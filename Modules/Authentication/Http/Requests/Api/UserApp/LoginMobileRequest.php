<?php

namespace Modules\Authentication\Http\Requests\Api\UserApp;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginMobileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "phone_code"        => "required",
            'mobile'            => ['required','numeric','digits_between:3,20'],
            'password'            => ['required']
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

    public function messages()
    {
        $v = [
            'email.required'      =>   __('authentication::api.login.validation.email.required'),
            'email.email'         =>   __('authentication::api.login.validation.email.email'),
            'password.required'   =>   __('authentication::api.login.validation.password.required'),
            'password.min'        =>   __('authentication::api.login.validation.password.min'),
        ];

        return $v;
    }
}
