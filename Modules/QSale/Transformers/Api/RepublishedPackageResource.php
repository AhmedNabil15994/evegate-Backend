<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class RepublishedPackageResource extends JsonResource
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
            "title"         => $this->title,
            "description"   => htmlView($this->description) ,
            "price"  => $this->price,
            "duration"   => $this->duration,
            "is_free"        => $this->is_free,
            
        ];
    }
}
