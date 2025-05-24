<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class CoinPaymentTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"            => $this->id,
            "transaction_id"          => $this->transaction_id,
            "status"          => $this->status,
            "transaction_provider"          => $this->transaction_provider,
            "coin"         => new CoinResource($this->coin),
        ];
    }
}
