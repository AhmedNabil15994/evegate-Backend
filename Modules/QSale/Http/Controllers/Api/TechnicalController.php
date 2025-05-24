<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;

use Modules\User\Enums\UserType;

use Modules\QSale\Transformers\Api\AdsResource;

use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Repositories\Api\TechnicalRepository as Repo;
use Modules\User\Transformers\Api\UserResource as ModelResource;

class TechnicalController extends ApiController
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $models = $this->repo->getAllActive($request, []);

        return $this->responsePagnation(
            ModelResource::collection($models)
        );
    }

    public function show(Request $request, $id)
    {
        $model = $this->repo->findById($id, []);
        return $this->response(
            new ModelResource($model)
        );
    }

    public function getAds(Request $request, $id)
    {
        $model = $this->repo->findById($id, []);
        $ads    = $this->repo->getAdsFor($model);
        return $this->responsePagnationWithData(
            AdsResource::collection($ads),
            ["technical"=>new ModelResource($model) ]
        );
    }
}
