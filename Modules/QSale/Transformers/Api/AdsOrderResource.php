<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class AdsOrderResource extends JsonResource
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
            "total"         => $this->total,
            "is_paid"       => $this->is_paid ? true : false,
            "addations"     => AdsAddationResource::collection($this->whenLoaded("addations")),
            'start_date' => $this->start_date,
            'expire_date' => $this->expire_date,

        ];
    }
}
