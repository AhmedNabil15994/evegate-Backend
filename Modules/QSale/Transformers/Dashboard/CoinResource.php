<?php

namespace Modules\QSale\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class CoinResource extends JsonResource
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
            'title' => $this->title,
            'status' => $this->status,
            'apple_tier_id' => optional($this->tier)->price,
            'coins_number' => $this->coins_number,
            "created_at"    => $this->created_at->format("d-m-Y"),
            "deleted_at"       => $this->deleted_at,
        ];
    }
}
