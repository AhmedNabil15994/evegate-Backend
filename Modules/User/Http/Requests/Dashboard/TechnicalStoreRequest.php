<?php

namespace Modules\User\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use Modules\User\Enums\SocialType;
use Illuminate\Foundation\Http\FormRequest;

class TechnicalStoreRequest extends FormRequest
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
            "package_id" => "required|exists:packages,id",
            "subscription"      => "sometimes|required_if:use_pakcage_info,1",
            "subscription.max_use"=> "sometimes|required|integer|min:1",
            "subscription.current_use"=> "sometimes|required|integer|max:".$this->input("subscription.max_use"),
            "subscription.start_at"   => "sometimes|required|date",
            "subscription.end_at"   => "sometimes|required|after_or_equal:subscription.start_at",
            "subscription.money"    => "sometimes|required|numeric|min:0",
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
        return [];
    }
  
    
}
