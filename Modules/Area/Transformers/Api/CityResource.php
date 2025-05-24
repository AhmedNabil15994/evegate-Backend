<?php

namespace Modules\Area\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'title'         => optional($this->translateOrDefault(locale()))->title,
            'states'        => StateResource::collection($this->whenLoaded("states")),
        ];
    }
}
