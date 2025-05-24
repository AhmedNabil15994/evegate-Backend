<?php

namespace Modules\User\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class TechnicalResource extends JsonResource
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
           'name'          => $this->name,
           'email'         => $this->email,
           'mobile'        => $this->phone_code ."".$this->mobile,
           'image'         => url($this->image),
           "is_active"     => $this->is_active, 
           "admin_verified"=> $this->admin_verified,
           "number_of_free"=> $this->number_of_free,
           "type"          => $this->type, 
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
