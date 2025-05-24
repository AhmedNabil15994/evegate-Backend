<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\Attribute\Transformers\Api\OptionResource;
use Modules\Attribute\Transformers\Api\AttributeResource;

class AdsAttributeResource extends JsonResource
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
            "id"        => $this->id ,
            "attribute" => new AttributeResource($this->whenLoaded("attribute")),
            "option"    => new OptionResource($this->whenLoaded("option")) ,
            "value"     => $this->value ?? "",
          
        ];
    }
}
