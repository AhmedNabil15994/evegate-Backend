<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class AddationResourceHome extends JsonResource
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
            "id"            => $this->id ,
            "name"          => $this->name,
            "description"   => $this->when($request->with_desc, htmlView($this->description)) ,
            "price"         => (int)$this->price,
            "type"          => $this->type,
            "ads"           => AdsResource::collection($this->getAds($request)),
            
        ];
    }
}
