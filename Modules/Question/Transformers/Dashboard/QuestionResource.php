<?php

namespace Modules\Question\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            "id"        =>   $this->id,
            "question"  =>   $this->translateOrDefault(locale())->question, 
            "answer"    =>   $this->translateOrDefault(locale())->answer,
            "is_active" =>   $this->is_active,
            'deleted_at'=> $this->deleted_at,
            'created_at'=> date('d-m-Y' , strtotime($this->created_at)),
        ];
    }
}
