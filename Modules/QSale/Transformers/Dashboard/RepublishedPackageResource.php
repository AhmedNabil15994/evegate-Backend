<?php

namespace Modules\QSale\Transformers\Dashboard;

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
            "description"   => $this->description ,
            "status"        => $this->status,
            "price"         => $this->price,
            "duration"      => $this->duration,
            "is_free"       => $this->is_free,
            "created_at"    => $this->created_at->format("d-m-Y"),
            "deleted_at"    => $this->deleted_at   ,
        ];
    }
}
