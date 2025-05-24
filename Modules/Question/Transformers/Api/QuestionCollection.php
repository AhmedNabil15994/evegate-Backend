<?php

namespace Modules\Question\Transformers\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Question\Transformers\Api\QuestionResource;

class QuestionCollection extends ResourceCollection
{
    public $collects = QuestionResource::class ;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
