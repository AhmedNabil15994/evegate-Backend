<?php

namespace Modules\User\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use Modules\User\Enums\SocialType;
use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  [
            "title"  => "required|string|max:255" ,
            "description"=> "nullable|string",
            "image"       => "nullable|image",
            "mobile"       => "nullable|string|min:5|max:25",
            "country_id"    => ["required", "exists:countries,id"]  ,
            "city_id"       => ["required",Rule::exists("cities", "id")->where(function ($query) {
                $query->where("country_id", $this->country_id);
            }) ],
             "state_id"       => ["required",Rule::exists("states", "id")->where(function ($query) {
                 $query->where("city_id", $this->city_id);
             }) ],
             "socials"      => "nullable|array|distinct",
             "socials.*.key"  => "required|in:".implode(',', SocialType::getConstList()),
             "socials.*.link"  => "nullable|url"
        ];
    }

    public function authorize()
    {
        return true;
    }

    

    protected function prepareForValidation()
    {
        if (!$this->has('country_id')) {
            $this->merge([ 'country_id' => config("customs.country_id") ]);
        }
        if (is_array($this->socials)) {
            $collect = collect($this->socials)->unique("key") ;
            $this->merge([ 'socials' => $collect->values()->all() ]);
        }
    }
}
