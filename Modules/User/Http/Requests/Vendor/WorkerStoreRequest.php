<?php

namespace Modules\User\Http\Requests\Vendor;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class WorkerStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    
        
        $rule = [
            'name'       => 'required|max:255',
            "phone_code" => "required",
            'mobile'     => ['required',
                             Rule::unique("users")->where(function ($query) {
                                 $query->where("mobile", $this->mobile)
                                ->where("phone_code", $this->phone_code);
                             }),
                            'numeric','digits_between:8,15'],
            'email'          => 'nullable|email|unique:users,email',
            'password'       => 'required|min:6|same:confirm_password',
            "image"          => "nullable|image" ,

        ];

       
        if ($this->getMethod() == "PUT"):
            $id = $this->route("id");
        $rule["email"]      = $rule["email"].",".$id;
        $rule["password"]   = str_replace("required", "nullable", $rule["password"]);
        $rule["mobile"][1]  = Rule::unique("users")->where(function ($query) use (&$id) {
            $query->where("mobile", $this->mobile)
                ->where("phone_code", $this->phone_code)
                ->where("id", "!=", $id);
        });
           
        endif;

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

        // $v = [
        //     'name.required'           => __('user::dashboard.users.validation.name.required'),
        //     'email.required'          => __('user::dashboard.users.validation.email.required'),
        //     'email.unique'            => __('user::dashboard.users.validation.email.unique'),
        //     'mobile.required'         => __('user::dashboard.users.validation.mobile.required'),
        //     'mobile.unique'           => __('user::dashboard.users.validation.mobile.unique'),
        //     'mobile.numeric'          => __('user::dashboard.users.validation.mobile.numeric'),
        //     'mobile.digits_between'   => __('user::dashboard.users.validation.mobile.digits_between'),
        //     'password.required'       => __('user::dashboard.users.validation.password.required'),
        //     'password.min'            => __('user::dashboard.users.validation.password.min'),
        //     'password.same'           => __('user::dashboard.users.validation.password.same'),
        // ];

        // return $v;
        return [];
    }
    protected function prepareForValidation()
    {
        

    
    }
}
