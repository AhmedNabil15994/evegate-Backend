<?php

namespace Modules\Question\Repositories\Api;

use Illuminate\Support\Facades\Storage;
use Modules\Question\Entities\Question;

class QuestionRepositry
{

    function __construct(Question $model)
    {
        $this->model      = $model;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        
        return $this->model->where("is_active", 1)
                 ->orderBy($order, $sort)
                 ->paginate($request->page_count ?? config("app.page_count", 15)); 
       
    }

    

   
    

   
}
