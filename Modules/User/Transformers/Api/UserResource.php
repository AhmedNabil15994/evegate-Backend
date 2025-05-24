<?php

namespace Modules\User\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\Area\Transformers\Api\CountryResource;
use Modules\QSale\Transformers\Api\SubscriptionResource;
use Modules\User\Transformers\Api\OfficeResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'image'          => url($this->image),
            "email"          => $this->email ?? "",
            "phone_code"     => $this->phone_code,
            'mobile'         => $this->mobile,
            "ads_count"      => $this->ads_count,
            "is_active"      => $this->is_active ? 1 : 0,
            "type"           => $this->type,
            "number_of_free" => $this->number_of_free,
            "is_verified"    => $this->is_verified ? 1 : 0,
            "admin_verified" => $this->admin_verified ? 1 : 0,
            "office"         => new OfficeResource($this->whenLoaded("office")),
            "company"        => new CompanyResource($this->whenLoaded("company")),
            "firebase_uuid"  => $this->firebase_uuid,
            "rates_avg"      => $this->when(!is_null($this->rates_avg), (float)$this->rates_avg),
            "rates_count"    => $this->when(!is_null($this->rates_count), $this->rates_count),
            "country"   => new CountryResource($this->country),
            "subscription"   => $this->subscription ? new SubscriptionResource($this->subscription->load('package')) : null,
            "coin_blance"   => $this->coin_blance,
        ];
    }
}
