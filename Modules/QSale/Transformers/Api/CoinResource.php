<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

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
            "id"            => $this->id,
            "title"          => $this->title,
            "description"          => $this->description,
            "coins_number"   => $this->coins_number,
            "tier"         => new TeirResource($this->tier),
        ];
    }
}
