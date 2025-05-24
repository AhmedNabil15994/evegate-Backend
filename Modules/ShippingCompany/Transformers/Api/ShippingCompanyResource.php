<?php

namespace Modules\ShippingCompany\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\QSale\Transformers\Api\MediaResource;
use Modules\Category\Transformers\Api\CategoryResource;

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
      "id"             => $this->id,
      "image"          => asset($this->image),
      "title"          => $this->title,
      "phone_number"   => $this->phone_number ?? "",
      "phone_whatsapp" => $this->phone_whatsapp ?? "",
      "address"        => $this->address,
      "lat"            => $this->lat,
      "long"           => $this->long,
      "created_at"     => $this->created_at->format("d-m-Y h:i a"),

    ];
  }
}
