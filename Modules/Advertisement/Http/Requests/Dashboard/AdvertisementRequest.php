<?php

namespace Modules\Advertisement\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule= [
          'image'    => 'required|image',
          'link'     => 'required_if:type,out',
          'start_at' => 'required_if:type,out',
          'end_at'   => 'required_if:type,out',
          "ads_id"   => 'required_if:type,in|exists:ads,id',
        ];  
        if(strtolower($this->getMethod()) == "put"){
            $rule["image"] = "nullable|image";
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
          'image.required'         => __('advertisement::dashboard.advertisement.validation.image.required'),
          'link.required_if'          => __('advertisement::dashboard.advertisement.validation.link.required'),
          'start_at.required'      => __('advertisement::dashboard.advertisement.validation.start_at.required'),
          'end_at.required'        => __('advertisement::dashboard.advertisement.validation.end_at.required'),
        ];

        return $v;
    }
}
