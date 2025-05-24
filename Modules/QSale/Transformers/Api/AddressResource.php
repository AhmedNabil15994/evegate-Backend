<?php

namespace Modules\QSale\Transformers\Api;

use Modules\Area\Transformers\Api\CityResource;
use Modules\Area\Transformers\Api\StateResource;
use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\Area\Transformers\Api\CountryResource;

class AddressResource extends JsonResource
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
            "id"                 => $this->id ,
            "country"            => new CountryResource($this->whenLoaded("country")) ,
            "city"               => new CityResource($this->whenLoaded("city")) ,
            "state"              => new StateResource($this->whenLoaded("state")) ,
            
        ];
    }
}
