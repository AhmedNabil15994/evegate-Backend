<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\QSale\Transformers\Api\PackageResource;

use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Repositories\Api\PackageRepository as Repo;


class PackageController extends ApiController
{
    function __construct(Repo $repo)
    {
        
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $users =  $this->repo->getAll($request);
        return $this->responsePagnation(
            PackageResource::collection($users)
        );
    }

    public function show(Request $request, $id)
    {
        $package  =  $this->repo->findById($id);
    
        return $this->response(
            new PackageResource($package)
        );
        
    }

   



    
}
