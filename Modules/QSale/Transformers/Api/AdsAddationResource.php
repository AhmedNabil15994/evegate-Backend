<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class AdsAddationResource extends JsonResource
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
            "addation"  => new AddationResource($this->whenLoaded("addation")),
            "price"     => $this->price?? "",
        ];
    }
}
