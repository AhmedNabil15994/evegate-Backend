<?php

namespace Modules\QSale\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class CoinTransactionResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => optional($this->user)->name,
            'balance_before' => $this->balance_before,
            'coins_number' => $this->coins_number,
            'balance_after' => $this->balance_after,
            'details' => view("qsale::dashboard.coins.transaction-details",["transaction" => $this])->render(),
            "created_at"    => $this->created_at->format("d-m-Y"),
            "deleted_at"       => $this->deleted_at,
        ];
    }
}
