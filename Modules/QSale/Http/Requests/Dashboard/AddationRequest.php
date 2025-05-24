<?php

namespace Modules\QSale\Http\Requests\Dashboard;

use Modules\User\Enums\UserType;
use Modules\QSale\Enum\AddationType;
use Illuminate\Foundation\Http\FormRequest;

class AddationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            "name"              => "required|array",
            "name.*"            => "required|string|max:255",
            "price"             => "required|numeric|min:0",
            "description.*"     => "nullable|string",
            "type"            => "required|in:" . implode(",", AddationType::getConstList()),
            "days"              => "required|integer",
            "user_type"         => "nullable|in:" . implode(",", UserType::getConstList())

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
