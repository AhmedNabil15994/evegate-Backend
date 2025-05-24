<?php

namespace Modules\Authentication\Http\Requests\Api\UserApp;

use Illuminate\Validation\Rule;
use Modules\User\Enums\UserType;
use Modules\User\Enums\SocialType;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        $rule = [
            "type"      => "required|in:" . implode(",", UserType::getConstList()),
            'name'      => 'required|alpha_dash|unique:users,name',
            "phone_code" => "required",
            'mobile'     => [
                'required',
                Rule::unique("users")->where(function ($query) {
                    $query->where("mobile", $this->mobile)
                        ->where("phone_code", $this->phone_code);
                }),
                'numeric', 'digits_between:3,20'
            ],
            'email'          => 'nullable|email|unique:users,email',
            'password'       => 'required|confirmed|min:6',
            "image"          => "nullable|image",
            "country_id" => "required|exists:countries,id",
            "firebase_uuid"  => "sometimes|nullable|unique:users,firebase_uuid"
        ];
        
        if ($this->type == UserType::COMPANY) {
            $rule["title"] = "required|string|max:255";
            $rule["description_work"] = "nullable";
            $rule["address"]          = "nullable";
            $rule["document"]         = "nullable|file";
            $rule["categories"]       = "nullable|array";
            $rule["categories.*"]     = "nullable|exists:categories,id";
            $rule = array_merge($rule, [
                "cover"             => "nullable|image",
                "delivery_receive"  => "nullable",
                "socials"      => "nullable|array|distinct",
                "socials.*.key"  => "required|in:" . implode(',', SocialType::getConstList()),
                "socials.*.link"  => "nullable|url"
            ]);
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

    public function messages()
    {
        $v = [
            'name.required'         =>   __('authentication::api.register.validation.name.required'),
            'mobile.required'       =>   __('authentication::api.register.validation.mobile.required'),
            'mobile.unique'         =>   __('authentication::api.register.validation.mobile.unique'),
            'mobile.numeric'        =>   __('authentication::api.register.validation.mobile.numeric'),
            'mobile.digits_between' =>   __('authentication::api.register.validation.mobile.digits_between'),
            'email.required'        =>   __('authentication::api.register.validation.email.required'),
            'email.unique'          =>   __('authentication::api.register.validation.email.unique'),
            'email.email'           =>   __('authentication::api.register.validation.email.email'),
            'password.required'     =>   __('authentication::api.register.validation.password.required'),
            'password.min'          =>   __('authentication::api.register.validation.password.min'),
            'password.confirmed'    =>   __('authentication::api.register.validation.password.confirmed'),
        ];

        return $v;
    }
}
