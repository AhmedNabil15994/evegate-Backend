<?php
namespace Modules\User\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'            => 'required',
            "phone_code"      => "nullable",
            'mobile'          => 'required|numeric|digits_between:6,20|unique:users,mobile,'.auth()->id().'',
            'email'           => 'nullable|unique:users,email,'.auth()->id().'',
            "image"           => "nullable|image"  , 
            'password'        => 'nullable|confirmed|min:6',           
        ];
    }
}
