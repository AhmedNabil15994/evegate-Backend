<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class AdTypeResource extends JsonResource
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
            "icon"          => url($this->icon),
            "description"   => $this->when($request->with_desc, htmlView($this->description)) ,
          
            
        ];
    }
}
