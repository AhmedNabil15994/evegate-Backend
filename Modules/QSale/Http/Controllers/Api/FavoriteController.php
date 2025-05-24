<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\QSale\Entities\Ads;

use Modules\QSale\Transformers\Api\AdsResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Repositories\Api\FavoriteRepository as Repo;

class FavoriteController extends ApiController
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $user  = auth()->user();

        $with = [
            "media", "addations", "attributes", "category",
            'user' => fn ($q) => $q
                ->adsCount()->withAvgRate()
                ->with(["company" => fn ($c) => $c->with(["categories", "state", "city"])]),
            "country", "address" /*"city", "state"*/
        ];
        $ads =  $this->repo->listCurrentUser($user, $with);
        return $this->responsePagnation(
            AdsResource::collection($ads)
        );
    }

    public function toggle(Request $request, $id)
    {
        $user  = auth()->user();
        $ads   = $this->repo->getAds($id);
        if (!$ads) return $this->notFoundResponse();
        $toggle =  $this->repo->toggleToCurrentUser($user, $id);
        return $this->response(
            [
                "is_add" => in_array($id, $toggle["attached"])
            ]
        );
    }

    public function add(Request $request,  $id)
    {
        $user  = auth()->user();
        $ads   = $this->repo->getAds($id);
        if (!$ads) return $this->notFoundResponse();
        $this->repo->addToCurrentUser($user, $id);

        return $this->response(
            []
        );
    }

    public function remove(Request $request,  $id)
    {
        $user  = auth()->user();
        $toggle =  $this->repo->deleteFromCurrentUser($user, $id);
        return $this->response(
            []
        );
    }

    public function checkIfAdd(Request $request,  $id)
    {

        if (!$request->user_id && !auth("api")->check()) {
            return $this->response([
                "is_added" => false
            ]);
        }
        $user_id  = $request->user_id ??  auth("api")->id();



        return $this->response([
            "is_added" => $this->repo->isAddToUserId($user_id, $id)
        ]);
    }
}
