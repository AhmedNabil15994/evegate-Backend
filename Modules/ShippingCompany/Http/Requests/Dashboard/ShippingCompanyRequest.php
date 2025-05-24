<?php

namespace Modules\ShippingCompany\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ShippingCompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title.*'           => 'required|max:255',
            'image'             => 'nullable|image',
            'address.*'         => 'required',
            "phone_number"      => "required|max:255",
            "phone_whatsapp"    => "required|max:255",
            "lat"               => "required|max:255",
            "long"              => "required|max:255",

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
