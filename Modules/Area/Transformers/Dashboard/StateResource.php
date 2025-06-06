<?php

namespace Modules\Area\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
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
            'title'         => $this->translateOrDefault(locale())->title,
            'status'        => $this->status,
            'city_id'       =>
            optional(optional($this->city)
                ->translateOrDefault(locale()))
                ->title,
            'deleted_at'    => $this->deleted_at,
            'created_at'    => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
