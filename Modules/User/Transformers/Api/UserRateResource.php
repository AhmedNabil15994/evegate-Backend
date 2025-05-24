<?php

namespace Modules\User\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\Api\OfficeResource;
use Modules\User\Transformers\Api\SelimUserResource;

class UserRateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           'rate'          => $this->rate ,
           'note'          => $this->note,
           "created_at"    => $this->created_at->format("d-m-y H:i:a"),
           "updated_at"    => $this->updated_at->format("d-m-y H:i:a"),
           "user"          =>  new SelimUserResource($this->whenLoaded("user")) ,
           "from"          =>  new SelimUserResource($this->whenLoaded("from")) ,
       ];
    }
}
