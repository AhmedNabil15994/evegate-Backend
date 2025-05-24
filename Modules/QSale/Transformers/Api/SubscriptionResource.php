<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\Api\SelimUserResource;

class SubscriptionResource extends JsonResource
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
            "id"        => $this->id,
            "is_free"   => $this->is_free,
            "is_default"=> $this->is_default,
            "duration_of_ads"=> $this->duration_of_ads,
            "allow_use"          => $this->checkAllowUse(),
            "start_at"           => $this->start_at ?? "",
            "end_at"             => $this->end_at ?? "",
            "current_use"       => $this->current_use,
            "max_use"           => $this->max_use ,
            "renewal_at"        => $this->renewal_at ? $this->renewal_at->format("d-m-Y h:i a") : "",
            "renewal_count"     => $this->renewal_count,
            "package"           => new PackageResource($this->whenLoaded("package"))    ,
            "user"               => new SelimUserResource($this->whenLoaded("user")) ,
            "created_at"          => $this->created_at->format("d-m-Y h:i a"),

        ];
    }
}
