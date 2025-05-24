<?php

namespace Modules\QSale\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            "status"       => $this->status,
            "price"  => $this->price,
            "duration"   => $this->duration,
            "number_of_ads"      => $this->number_of_ads,
            "duration_of_ads"      => $this->duration_of_ads,
            "number_of_image"    => $this->number_of_image,
            "is_free"        => $this->is_free,
            "created_at"    => $this->created_at->format("d-m-Y"),
            "deleted_at"       => $this->deleted_at   ,
        ];
    }
}
