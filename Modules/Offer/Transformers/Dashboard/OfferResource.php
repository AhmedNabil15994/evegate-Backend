<?php

namespace Modules\Offer\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            "image"      => url($this->image),
            "title"      => $this->title,
            "description"=> $this->description,
            "phone_number"=> $this->phone_number ?? "",
            "phone_whatsapp"=> $this->phone_whatsapp ?? "",
            "percent"    => $this->percent . "%",
            "created_at"    => $this->created_at->format("d-m-Y"),
            "deleted_at"       => $this->deleted_at   ,
            "start_at"      => $this->start_at,
            "end_at"        => $this->end_at
        ];
    }
}
