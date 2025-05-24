<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\QSale\Enum\AdsStatus;

use Modules\QSale\Entities\Addation;
use Modules\QSale\Transformers\Api\AdsResource;
use Modules\QSale\Repositories\Api\AdsRepository;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Http\Requests\Api\AdsOrderRequest;
use Modules\QSale\Transformers\Api\AdsOrderResource;
use Modules\QSale\Repositories\Api\AdsOrderRepository as Repo;

class AdsOrderController extends ApiController
{
    public $repo;
    public function __construct(Repo $repo, AdsRepository $adsRepo)
    {
        $this->repo    = $repo;
        $this->adsRepo = $adsRepo;
    }

    public function create(AdsOrderRequest $request, $id)
    {
        $ads = $this->adsRepo->findByAuthAndId($id);
        
        if (in_array($ads->status, [AdsStatus::EXPIRED, AdsStatus::WAIT]) || $ads->checkIsNotExpired()) {
            return $this->error(__("qsale::api.ads.not_allow_addations"));
        }

        $coinsCost = getNumberOfCoinsForAdByUserType();
        $addationsCost = Addation::active()->whereIn("id", $request->addations)->sum('price');

        if($request->user()->coin_blance < $addationsCost){
            return $this->error(__("your coins balance not enough,") . __(" asked coins amount : ") . "$addationsCost," . __(" your balance is: ") . $request->user()->coin_blance);
        }

        $orderAds = $this->repo->create($ads, $request);

        $this->repo->paymentHandler($orderAds);
        
        return $this->response([
            "order" => new AdsOrderResource($orderAds),
            "url"   => null
        ]);
    }
}
