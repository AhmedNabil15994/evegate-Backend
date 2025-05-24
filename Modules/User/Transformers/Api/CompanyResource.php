<?php

namespace Modules\User\Transformers\Api;

use Modules\Area\Transformers\Api\CityResource;
use Modules\Area\Transformers\Api\CountryResource;
use Modules\User\Transformers\Api\UserResource;
use Modules\Area\Transformers\Api\StateResource;
use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\Api\CategoryResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'address'         => $this->address,
            "description_work" => $this->description_work,
            "document"        => $this->document ? url($this->document) : "",
            "cover"        => $this->cover ? url($this->cover) : "",
            "delivery_receive" => (int) $this->delivery_receive,
            "socials"       => $this->mapSocials(),
            "user"            => new UserResource($this->whenLoaded("user")),
            "categories"      => CategoryResource::collection($this->whenLoaded("categories")),
            "country"   => new CountryResource(optional($this->user)->country),
            "state"           => new StateResource($this->whenLoaded("state")),
            "city"           => new CityResource($this->whenLoaded("city")),
            'lat' => $this->lat,
            'long' => $this->long,
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
                "key"     => $social["key"] ?? "",
                "link"   => $social["link"] ?? ""
            ];
        }
        return $data;
    }
}
