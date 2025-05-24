<?php

namespace Modules\Apps\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            "id"   => $this->id ,
            "type" => __('apps::dashboard.contact.datatable.typeOf.'.$this->type) ,
            "username" => $this->username ,
            "email" => $this->email ,
            "message" => $this->message ,
            "mobile" => $this->mobile ,
            "created_at" => $this->created_at->format("d-m-Y h:i a")
        ];
    }
}
