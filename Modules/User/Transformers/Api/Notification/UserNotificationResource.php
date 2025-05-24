<?php

namespace Modules\User\Transformers\Api\Notification;

use  Illuminate\Http\Resources\Json\JsonResource;

class UserNotificationResource extends JsonResource
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
            "id"              => $this->id ,
            "type"            => $this->data['type'],
            "image"           => $this->data["image"] , 
            "actionId"        => $this->data["id"] , 
            "idFor"           => $this->data["idFor"],
            "read_at"         => $this->read_at??"",
            "title"           =>__("devicetoken::fcm.{$this->data['type']}.title", $this->data['title'] ),
            "description"     =>__("devicetoken::fcm.{$this->data['type']}.description", $this->data['description'])
        ];
    }
}
