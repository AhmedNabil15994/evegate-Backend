<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;

use Modules\User\Enums\UserType;
use Modules\QSale\Enum\AdsStatus;
use Modules\QSale\Entities\Addation;
use Modules\QSale\Http\Requests\Api\AdsRequest;
use Modules\QSale\Transformers\Api\AdsResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Http\Requests\Api\AdsUpdateRequest;
use Modules\QSale\Http\Requests\Api\CompliantRequest;
use Modules\QSale\Repositories\Api\AdsRepository as Repo;


class AdsController extends ApiController
{
    public $repo;
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function store(AdsRequest $request)
    {
        $coinsCost = getNumberOfCoinsForAdByUserType();
        $addationsTotal = 0;

        if (is_array($request->addations)) {
            $addationsTotal = Addation::active()->whereIn("id", $request->addations)->sum('price');
        }

        $totalCost = $coinsCost + $addationsTotal;

        if($request->user()->coin_blance < $totalCost){
            return $this->error(__("your coins balance not enough,") . __(" asked coins amount : ") . "$totalCost," . __(" your balance is: ") . $request->user()->coin_blance);
        }

        $ads =  $this->repo->store($request);
        $ads->load(["subscription", "addations", "media", "address"]);


        return $this->response(
            new AdsResource($ads)
        );
    }

    public function current(Request $request)
    {
        $ads =  $this->repo->getCurrentForUser($request);
        return $this->response(
            $ads ? new AdsResource($ads) : null
        );
    }

    public function index(Request $request)
    {
        $with = [
            "media", "addations", "attributes", "category", "country",
            'user' => fn ($q) => $q
                ->adsCount()
                ->withAvgRate()
                ->with(["company" => fn ($c) => $c->with(["categories", "state", "city"])]),
            "country", "address" /*"city", "state"*/
        ];
        $ads =  $this->repo->listActive($request, $with);
        return $this->responsePagnation(
            AdsResource::collection($ads)
        );
    }


    public function update(AdsUpdateRequest $request, $id)
    {
        $ads =  $this->repo->update($request, $id);
        $ads->load(["subscription", "addations", "media"]);
        return $this->response(
            new AdsResource($ads)
        );
    }

    public function updateAfterCreate(AdsUpdateRequest $request, $id)
    {
        $ads = $this->repo->findByAuthAndId($id);
        if ($ads->status != AdsStatus::WAIT && !$ads->checkIsPublish()) {
            return $this->error(__("qsale::api.ads.not_not_allow_edit"));
        }

        $ads =  $this->repo->updateAfterCreate($request, $ads);

        $ads->load(["subscription", "addations", "media"]);
        return $this->response(
            new AdsResource($ads)
        );
    }


    public function delete(Request $request, $id)
    {
        $ads =  $this->repo->findByAuthAndId($id, ["user.currentSubscription", "media"]);
        $this->repo->delete($ads);
        return $this->response([]);
    }

    public function confirm(Request $request, $id)
    {
        $ads      =  $this->repo->findByAuthAndId($id);
        if ($ads->is_paid || $ads->status != AdsStatus::WAIT) {
            return $this->error(__("qsale::api.ads.not_allow_payment"));
        }
        $payment = $this->repo->confirm($ads);
        return $this->response([
            "ads"       => new AdsResource($ads),
            "url"       => null,
        ]);
    }

    public function adsMe(Request $request)
    {
        $with = ["user", "media", "addations", "attributes", "category", "user.company", "address" /*"city", "state"*/];

        $ads = $this->repo->listAdsMe($request, $with);
        return $this->responsePagnation(
            AdsResource::collection($ads)
        );
    }

    public function show(Request $request, $id)
    {
        $with = ["user", "media", "addations", "attributes", "category", "user" => fn ($q) => $q->withAvgRate(), "user.company", "address"];
        $ads =  $this->repo->findById($id, $with);
        return $this->response(
            new AdsResource($ads)
        );
    }

    public function related(Request $request, $id)
    {
        $with = ["user", "media", "addations", "attributes", "category", "user.company", "address",/*"country", "city", "state"*/];
        $ads =  $this->repo->findById($id, ["category"]);
        $related = $this->repo->getRelated($ads, $with);
        return $this->response(
            AdsResource::collection($related)
        );
    }

    public function createCompliant(CompliantRequest $request, $id)
    {
        $ads =  $this->repo->findById($id);
        $compiant = $this->repo->createComplaint($ads, $request);
        return $this->response(
            []
        );
    }

    public function incrementView($id)
    {
        $ads =  $this->repo->findById($id);
        $view = $this->repo->incrementView($ads);
        return $this->response(
            ["view" => $ads->view]
        );
    }
}
