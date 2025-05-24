<?php

namespace Modules\QSale\Http\Requests\Api\Coin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentTransactionRequest extends FormRequest
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

                return  [
                    "tier_id" => "required",
                    "transaction_provider" => "required|in:apple,google",
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return  [
                   "status" => "required",
                   "transaction_id" => "nullable",
                   "tier_id" => "required|exists:apple_tiers,tier_id",
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
}
