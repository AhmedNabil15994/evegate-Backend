<?php

namespace Modules\ShippingCompany\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class ShippingCompanyResource extends JsonResource
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
            "id"         => $this->id,
            "image"      => asset($this->image),
            "title"      => $this->title,
            "address" => $this->description,
            "phone_number" => $this->phone_number ?? "",
            "phone_whatsapp" => $this->phone_whatsapp ?? "",
            "created_at"    => $this->created_at->format("d-m-Y"),
            "status"       => $this->status,
            "deleted_at"       => $this->deleted_at,

        ];
    }
}
