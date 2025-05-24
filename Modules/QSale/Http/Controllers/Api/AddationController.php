<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\QSale\Transformers\Api\AdsResource;

use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Transformers\Api\AddationResource;
use Modules\QSale\Repositories\Api\AddationRepository as Repo;


class AddationController extends ApiController
{
    public $repo;
    function __construct(Repo $repo)
    {

        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $users =  $this->repo->getAll($request);
        return $this->response(
            AddationResource::collection($users)
        );
    }

    public function listAds(Request $request, $id)
    {


        $addation  =  $this->repo->findById($id);
        $ads       = $this->repo->listAds(
            $addation,
            $request,
            ["user", "media", "addations", "attributes", "category", "office", "address",/*"country", "city", "state"*/]
        );

        return $this->responsePagnationWithData(
            AdsResource::collection($ads),
            ["addation" => new AddationResource($addation)]
        );
    }


    public function listAdsBasedType(Request $request)
    {

        $with = [
            "media", "addations", "attributes", "category", 'office',
            'user' => fn ($q) => $q
                ->adsCount()
                ->withAvgRate()
                ->with(["company" => fn ($c) => $c->with(["categories", "state", "city"])]),
            "country", "address" /*"city", "state"*/
        ];

        $ads = $this->repo->listAdsBasedType($request, $with);

        return $this->responsePagnationWithData(
            AdsResource::collection($ads),
        );
    }
}
