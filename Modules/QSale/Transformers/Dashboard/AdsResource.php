<?php

namespace Modules\QSale\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
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
            "id"                => $this->id ,
            "title"             => $this->title,
            "image"             =>optional($this->getFirstMedia("default_image"))->getUrl() ?? url("/uploads/default.png")  ,
            "description"       => $this->description ?? "",
            "mobile"            => $this->mobile ?? "",
            "hide_private_number"=> $this->hide_private_number,
            "start_at"           => $this->start_at ?? "",
            "end_at"             => $this->end_at ?? "",
            "is_publish"         => $this->checkIsPublish(),
            "duration"           => $this->duration ?? "",
            "status"             => $this->status,
            "is_paid"            => $this->is_paid,
            "type"               => $this->type    ,
            "price"              => $this->price ,
            "addation_total"     => $this->addation_total,
            "ads_price"          => $this->ads_price,
            "total"              => $this->total,
            "created_at"    => $this->created_at->format("d-m-Y"),
            "deleted_at"       => $this->deleted_at   ,
        ];
    }
}
