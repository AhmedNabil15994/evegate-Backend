<?php

namespace Modules\User\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
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
            "user_id"       => ["required",function($attribute, $value, $fail){
                if($value == auth()->id()){
                    $fail(__("qsale::api.user.not_allow_rate"));
                }
            },"exists:users,id"],
            "rate"          => "required|integer|max:5|min:0" ,
            "note"          => "nullable"

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
 