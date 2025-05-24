<?php

namespace Modules\User\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\Area\Transformers\Api\CountryResource;

class SelimUserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'image'         => url($this->image),
            "email"         => $this->email ?? "",
            "phone_code"    => $this->phone_code,
            'mobile'        => $this->mobile,
            "is_active"     => $this->is_active ? 1 : 0,
            "type"          => $this->type,
            "rates_avg"     => $this->when(!is_null($this->rates_avg), (float)$this->rates_avg),
            "rates_count"   => $this->when(!is_null($this->rates_count), $this->rates_count),
            "company"       => new CompanyResource($this->company),
            "country"   => new CountryResource($this->country),
            "ads_count"     => $this->ads_allow_count,
        ];
    }
}
