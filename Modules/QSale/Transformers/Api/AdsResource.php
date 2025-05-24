<?php

namespace Modules\QSale\Transformers\Api;

use Illuminate\Support\Str;
use Modules\Area\Transformers\Api\CityResource;
use Modules\Area\Transformers\Api\StateResource;
use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\QSale\Transformers\Api\MediaResource;
use Modules\User\Transformers\Api\OfficeResource;
use Modules\Area\Transformers\Api\CountryResource;
use Modules\QSale\Repositories\Api\SeenRepository;
use Modules\User\Transformers\Api\SelimUserResource;
use Modules\Category\Transformers\Api\CategoryResource;
use Modules\QSale\Transformers\Api\AdsAddationResource;
use Modules\QSale\Transformers\Api\AdsAttributeResource;
use Modules\QSale\Transformers\Api\SubscriptionResource;

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
        $defaultImage = $this->getFirstMedia("default_image");
        if ($defaultImage) {
            $defaultImage = new MediaResource($defaultImage);
        } else {
            $defaultImage  = [
                "id"  => null,
                "url" => url("/uploads/default.png"),
                "mime_type" => "image"
            ];
        }

        return [
            "id"                  => $this->id,
            "title"               => $this->title,
            'seen'                => $this->is_seen,
            "image"               => $defaultImage,
            "video"               =>  new MediaResource($this->getFirstMedia("video")),
            "description"         => $this->description ?? "",
            "is_feature"          => $this->when($this->is_feature, $this->is_feature),
            "mobile"              => $this->mobile ?? "",
            "hide_private_number" => (int) $this->hide_private_number,
            "start_at"           => $this->start_at ?? "",
            "end_at"             => $this->end_at ?? "",
            "is_publish"         => (int)$this->checkIsPublish(),
            "duration"           => $this->duration ?? "",
            "status"             => (int) $this->status,
            "view"               => $this->view,
            "is_paid"            => (int) $this->is_paid,
            "type"               => $this->type,
            "price"              => $this->price ? ($this->price . " " .(setting('default_currency') == "USD" ? (Str::contains($this->price, "$")? "" : "$"): setting('default_currency'))) : __("Free"),
            "offer_price"        => $this->offer_price ? ($this->offer_price . " " .(setting('default_currency') == "USD" ? (Str::contains($this->offer_price, "$")? "" : "$") : setting('default_currency'))) : null,
            "addation_total"     => $this->addation_total,
            "ads_price"          => $this->ads_price,
            "total"              => $this->total,
            "user_type"          => $this->user_type,
            "created_at"         => $this->created_at->format("d-m-Y h:i a"),
            "user"               => new SelimUserResource($this->whenLoaded("user")),
            "office"             => new OfficeResource($this->whenLoaded("office")),
            "category"           => new CategoryResource($this->whenLoaded("category")),
            "subscription"       => new SubscriptionResource($this->whenLoaded("subscription")),
            "addations"          => AdsAddationResource::collection($this->whenLoaded("addations")),
            "attributes"         => AdsAttributeResource::collection($this->whenLoaded("attributes")),
            "attachs"            => $this->when(true, MediaResource::collection($this->getMedia("attachs"))),
            // "country"            => new CountryResource($this->whenLoaded("country")),
            "city"               => new CityResource($this->whenLoaded("city")),
            "state"              => new StateResource($this->whenLoaded("state")),
            "favorites_count"    => $this->user_favorites_count,
            "is_favorite"        => $this->is_favorite,
            "address"            => AddressResource::collection($this->whenLoaded("address")),
            "size"               => $this->size,
        ];
    }
}
