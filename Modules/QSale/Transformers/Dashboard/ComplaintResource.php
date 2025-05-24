<?php

namespace Modules\QSale\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
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
            "message"   => $this->message ,
            "created_at"    => $this->created_at->format("d-m-Y"),
        ];
    }
}
