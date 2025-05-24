<?php

namespace Modules\Advertisement\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
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
            'id'            => $this->id,
            'image'         => url($this->image),
            'link'          => $this->link,
            "type"          => $this->type,
            "ads_id"        => $this->ads_id, 
       ];
    }
}
