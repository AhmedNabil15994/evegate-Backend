<?php

namespace Modules\Area\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'id'            => $this->id,
            'title'         => $this->translateOrDefault(locale())->title,
            "cities"        => CityResource::collection($this->whenLoaded("cities")),
        ];
    }
}
