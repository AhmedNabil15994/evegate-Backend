<?php

namespace Modules\Category\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Area\Transformers\Api\CountryResource;
use Modules\Worker\Transformers\Api\WorkerResource;
use Modules\Attribute\Transformers\Api\AttributeResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        // dd($this->withDepth()->get()->toArray());
        return [
           'id'            => $this->id,
           'color'         => $this->color  ? $this->color  : "",
           'image'         => url($this->image),
        //    "price"         => $this->price, 
           "is_end_category"   =>$this->is_end_category,
           "slim_details"      => $this->slim_details,
           "type"          => $this->type,
           'title'         => $this->translateOrDefault(locale())->title,
           "country"   => new CountryResource($this->country),
           "all_children"  => CategoryResource::collection($this->whenLoaded("allChildren")) ,
           "attributes"    => AttributeResource::collection($this->whenLoaded("attributesAllow")), 
           "children"      => CategoryResource::collection($this->whenLoaded("children")) ,
           

       ];
    }
}
