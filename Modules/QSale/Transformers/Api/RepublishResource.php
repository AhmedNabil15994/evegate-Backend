<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class RepublishResource extends JsonResource
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
            "total"         => $this->total,
            "is_paid"       => $this->is_paid ? 1 : 0,
            "duration"      => $this->duration,
            "start_at"      => $this->start_at ?? "",
            "end_at"        => $this->end_at ?? "",
            "is_free"       => $this->is_free,
            "created_at"    => $this->created_at->format("d-m-Y"),
            
        ];
    }
}
