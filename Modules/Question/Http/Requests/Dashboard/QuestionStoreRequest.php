<?php

namespace Modules\Question\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class QuestionStoreRequest extends FormRequest
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
            "question.ar" => "required",
            "question.en" => "required",
            "answer.ar"   => "required",
            "answer.en"   => "required",
          
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
