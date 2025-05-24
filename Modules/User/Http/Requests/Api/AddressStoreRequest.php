<?php

namespace Modules\User\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddressStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule =  [
            //
            "state_id"   => "nullable|exists:states,id" ,
            "country_id" => "nullable|exists:countries,id"   ,
            "city_id" => "nullable|exists:cities,id"   ,
            "address"   =>"nullable|string|max:255",
            "streat"    =>"nullable|string|max:255"   , 
            "block"     => "nullable|string|max:255" ,
            "title"      => "nullable|string|max:255" ,
            "phone"      => "nullable|max:50" ,
            "name"       => "nullable|max:255" ,
            "is_save"    => "required|in:1,0"
        ];
        if (strtolower($this->getMethod()) == "put") {
           unset($rule["is_save"]);
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
}
