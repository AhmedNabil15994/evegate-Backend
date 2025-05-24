<?php

namespace Modules\Question\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Question\Transformers\Api\QuestionCollection;
use Modules\Question\Repositories\Api\QuestionRepositry  as Repo;

class QuestionController  extends ApiController
{
    function __construct(Repo $repo)
    {
         $this->repo = $repo;
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //
        $questions = $this->repo->getAllActive();
        return $this->responsePagnation(
            new QuestionCollection($questions)
        );

    }

   
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    
}
