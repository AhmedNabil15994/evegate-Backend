<?php

namespace Modules\QSale\Transformers\Api;

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
            "id"                 => $this->id,
            "title"              => $this->title,
            "description"        => $this->description,
            "price"              => $this->price,
            "duration"           => $this->duration,
            "number_of_ads"      => $this->number_of_ads,
            "number_of_image"    => $this->number_of_image,
            "duration_of_ads"      => $this->duration_of_ads,
            "type"          => $this->type,
            "first_time"     => $this->first_time,
            "is_free"        => $this->is_free,
            "created_at"    => $this->created_at->format("d-m-Y"),
            "subscription"  => $this->when($request->user_id, function () {
                $subscription = $this->subscriptions->first();
                return $subscription ? new SubscriptionResource($subscription) : null;
            })

        ];
    }
}
