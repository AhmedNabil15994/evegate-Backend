<?php

namespace Modules\Slider\Transformers\WebService;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           'image'         => url($this->image),
           'link'          => $this->link,
           "type"          => $this->type,
           "ads_id"        => $this->ads_id,
           "position"      => $this->position ,
       ];
    }
}
