<?php

namespace Modules\Category\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       
        switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':

                return [
                  'parent_id'     => 'required',
                  'title.*'         => 'required',//|unique:category_translations,title
                  "price"           => "nullable|numeric|min:0" ,
                  "attributes"      => "nullable|array", 
                  "attributes.*"    => "required|exists:attributes,id" ,
                  "type"            => "required"
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'parent_id'     => 'required',
                    'title.*'          => 'required' , // |unique:category_translations,title,'.$this->id.',category_id
                    "price"           => "nullable|numeric|min:0" ,
                    "attributes"      => "nullable|array", 
                    "attributes.*"    => "required|exists:attributes,id"
                ];
        }
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
            'parent_id.required'    => __('category::dashboard.categories.validation.category_id.required'),
        ];

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

          $v["title.".$key.".required"]  = __('category::dashboard.categories.validation.title.required').' - '.$value['native'].'';

          $v["title.".$key.".unique"]    = __('category::dashboard.categories.validation.title.unique').' - '.$value['native'].'';

        }

        return $v;

    }
}
