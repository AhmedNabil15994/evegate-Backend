<?php

namespace Modules\User\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $office = $this->office;
        return [
           'id'            => $this->id,
           'name'          => $this->title ??  $this->name,
           'email'         => $this->email,
           'mobile'        =>  $this->mobile ?? $this->phone_code ."".$this->mobile,
           'image'         => url(optional($office)->image ?? $this->image),
           "is_active"     => $this->is_active,
           "number_of_free"=> $this->number_of_free,
           "type"          => $this->type,
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y', strtotime($this->created_at)),
       ];
    }
}
