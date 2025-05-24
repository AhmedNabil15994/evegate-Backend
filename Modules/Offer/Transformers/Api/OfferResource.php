<?php

namespace Modules\Offer\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\QSale\Transformers\Api\MediaResource;
use Modules\Category\Transformers\Api\CategoryResource;

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
            "phone_number" => $this->phone_number ?? "",
            "phone_whatsapp" => $this->phone_whatsapp ?? "",
            "description"   => $this->when($request->with_desc || $request->is("api/offers/*"), htmlView($this->description)),
            "percent"    => $this->percent,
            "price_before" => $this->price_before,
            "price_after"  => $this->price_after,
            "category"    => new CategoryResource($this->whenLoaded("category")),
            "attachs"            => $this->when(true, MediaResource::collection($this->getMedia("attachs"))),
            "created_at" => $this->created_at->format("d-m-Y h:i a"),

        ];
    }
}
