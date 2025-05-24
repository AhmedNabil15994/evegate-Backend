<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\QSale\Enum\AdsStatus;

use Modules\QSale\Repositories\Api\AdsRepository;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Transformers\Api\RepublishResource;
use Modules\QSale\Transformers\Api\RepublishedPackageResource;
use Modules\QSale\Repositories\Api\RepublishedPackageRepository as Repo;

class RepublishedPackageController extends ApiController
{
    public function __construct(Repo $repo, AdsRepository $adsRepo)
    {
        $this->repo     = $repo;
        $this->adsRepo  = $adsRepo;
    }

    public function index(Request $request)
    {
        $users =  $this->repo->getAll($request);
        return $this->response(
            RepublishedPackageResource::collection($users)
        );
    }

    public function show(Request $request, $id)
    {
        $package  =  $this->repo->findById($id);
    
        return $this->response(
            new RepublishedPackageResource($package)
        );
    }


    public function republishAdsRequest(Request $request, $id)
    {
        $request->validate(["package_id"=>"required|exists:republished_packages,id"]);
        $package  =  $this->repo->findById($request->package_id);
        $ads      =  $this->adsRepo->findByAuthAndId($id);
       
        if ($ads->status == AdsStatus::WAIT || $ads->checkIsPublish()) {
            return $this->error(__("qsale::api.ads.not_not_allow_republish"));
        }

        $republish = $this->repo->republishAdsRequest($package, $ads);

        return $this->response([
            "republish" => new RepublishResource($republish),
            "url"       => $republish->payment  ?  $this->adsRepo->getUrlPayment($republish->payment) : ""
        ]);

        
    }
}
