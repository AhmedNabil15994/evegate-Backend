<?php

namespace Modules\User\Transformers\Api;

use Modules\Area\Transformers\Api\CityResource;
use Modules\Area\Transformers\Api\StateResource;
use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\Area\Transformers\Api\CountryResource;

class OfficeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           'title'         => $this->title ,
           "description"   => $this->description ?? "",
           'image'         => url($this->image),
           'mobile'        => $this->mobile ?? "",
           "status"        => $this->status ? true : false,
           "socials"       => $this->mapSocials(),
           "ads_count"     => $this->when(!is_null($this->ads_count), $this->ads_count),
           "country"       => new CountryResource($this->whenLoaded("country")) ,
           "city"          => new CityResource($this->whenLoaded("city")) ,
           "state"         => new StateResource($this->whenLoaded("state")) ,
           "user"          => new SelimUserResource($this->whenLoaded("user"))
       ];
    }


    protected function mapSocials()
    {
        $data = [];
        if (is_null($this->socials)) {
            return  $data;
        }

        foreach ($this->socials as $social) {
            $data[] = [
               "key"     => $social["key"] ?? "" ,
               "link"   => $social["link"] ?? ""
           ];
        }
        return $data;
    }
}
