<?php

namespace Modules\Attribute\Http\Controllers\Api;

use Illuminate\Http\Request;

use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Attribute\Transformers\Api\AttributeResource;
use Modules\Attribute\Repositories\Api\AttributeRepository as Repo;


class AttributeController extends ApiController
{
    function __construct(Repo $repo)
    {
        
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
       
        $attributes =  $this->repo->getAll($request);
        return $this->response(
            AttributeResource::collection($attributes)
        );
    }

   

   



    
}
