<?php

namespace Modules\Category\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'title'         => optional($this->translateOrDefault(locale()))->title,
            'image'         => url($this->image),
            'status'        => $this->status,
            'deleted_at'    => $this->deleted_at,
            "type"          => __("category::dashboard.categories.form.types." . $this->type),
            'created_at'    => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
