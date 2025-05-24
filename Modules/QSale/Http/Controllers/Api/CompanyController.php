<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;

use Modules\User\Enums\UserType;

use Modules\QSale\Transformers\Api\AdsResource;

use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Repositories\Api\CompanyRepository as Repo;
use Modules\User\Transformers\Api\UserResource as ModelResource;

class CompanyController extends ApiController
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $models = $this->repo->getAllActive($request, ["company.categories", "company.state", "company.city"]);

        return $this->responsePagnation(
            ModelResource::collection($models)
        );
    }

    public function show(Request $request, $id)
    {
        $model = $this->repo->findById($id, ["company.categories", "company.state", "company.city"]);
        $model->loadCount(["ads"=>fn ($q) => $q->allowShow(), "rates as rates_avg"=>function ($query) {
            $query->select(\DB::raw('ROUND( IFNULL(AVG(user_rates.rate),0) , 1)'));
        },
        "rates"]);
        return $this->response(
            new ModelResource($model)
        );
    }

    public function getAds(Request $request, $id)
    {
        $company = $this->repo->findById($id, ["company.categories", "company.state", "company.city"]);
        $ads    = $this->repo->getAdsForCompany($company);
        return $this->responsePagnationWithData(
            AdsResource::collection($ads),
            ["company"=>new ModelResource($company) ]
        );
    }
}
