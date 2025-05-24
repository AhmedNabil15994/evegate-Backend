<?php

namespace Modules\Question\Transformers\Api;

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
            "answer"    =>  htmlView( $this->translateOrDefault(locale())->answer)
        ];
    }
}
