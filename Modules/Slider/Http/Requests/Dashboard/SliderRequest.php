<?php

namespace Modules\Slider\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
                  'image'    => 'required|image',
                  'link'     => 'required_if:type,out',
                  'start_at' => 'required_if:type,out',
                  'end_at'   => 'required_if:type,out',
                  "ads_id"   => 'required_if:type,in|exists:ads,id',  
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'image'    => 'nullable|image',
                  "link"     => 'required_if:type,out',
                  'start_at' => 'required_if:type,out',
                  'end_at'   => 'required_if:type,out',
                  "ads_id"   => 'required_if:type,in',  
                  "ads_id"   => 'required_if:type,in|exists:ads,id', 

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
          'image.required'         => __('slider::dashboard.slider.validation.image.required'),
          'link.required_if'          => __('slider::dashboard.slider.validation.link.required'),
          'start_at.required'      => __('slider::dashboard.slider.validation.start_at.required'),
          'end_at.required'        => __('slider::dashboard.slider.validation.end_at.required'),
        ];

        return $v;

    }

    protected function prepareForValidation()
    {
        if ($this->has('categories') && $this->categories) {
            $this->merge([ 'categories' => explode(",", $this->categories) ]);
        }
    }
}
