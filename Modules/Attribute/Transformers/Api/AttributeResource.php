<?php

namespace Modules\Attribute\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
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
            "id"      => $this->id ,
            "type"     => $this->type,
            "name"     => $this->name,
            "icon"     => url($this->icon),
            "allow_from_to"=> $this->allow_from_to,
            "options"   => OptionResource::collection($this->whenLoaded("optionsAllow")),
            "validation"=> $this->validation
        ];
    }
}
