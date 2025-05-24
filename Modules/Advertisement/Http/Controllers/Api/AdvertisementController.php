<?php

namespace Modules\Advertisement\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Advertisement\Transformers\Api\AdvertisementResource;

use Modules\Advertisement\Repositories\Api\AdvertisementRepository as Repo;

class AdvertisementController extends ApiController
{

    function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {

        $models =  $this->repo->getRandomPerRequest();

        return $this->response(AdvertisementResource::collection($models));
    }
}
