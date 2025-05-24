<?php

namespace Modules\QSale\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class AddationResource extends JsonResource
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
            "name"         => $this->name,
            "description"   => $this->description ,
            "status"        => $this->status,
            "price"         => $this->price,
            "icon"          => url($this->icon),
            "created_at"    => $this->created_at->format("d-m-Y"),
            "deleted_at"       => $this->deleted_at   ,
        ];
    }
}
