<?php

namespace Modules\QSale\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Modules\QSale\Enum\AdsStatus;

use Modules\QSale\Repositories\Frontend\AdsRepository;
use Illuminate\Routing\Controller;

use Modules\QSale\Transformers\Api\RepublishResource;
use Modules\QSale\Transformers\Api\RepublishedPackageResource;
use Modules\QSale\Repositories\Api\RepublishedPackageRepository as Repo;

class RepublishedPackageController extends Controller
{
    public function __construct(Repo $repo, AdsRepository $adsRepo)
    {
        $this->repo     = $repo;
        $this->adsRepo  = $adsRepo;
    }

    public function index(Request $request, $id)
    {
        $packages =  $this->repo->getAll($request);
        $ad      =  $this->adsRepo->findByAuthAndId($id);

        // dd($packages->first()->title);
       
        // if ($ad->status == AdsStatus::WAIT || $ad->checkIsPublish()) {
        //     return redirect()->route("frontend.user.my_ads")
        //             ->withError(__("qsale::api.ads.not_not_allow_republish"));
        // }

        return view("qsale::frontend.republished-ads", compact("packages", "ad"));
       
    }

    


    public function republishAdsRequest(Request $request, $id)
    {
        $request->validate(["package_id"=>"required|exists:republished_packages,id"]);
        $package  =  $this->repo->findById($request->package_id);
        $ads      =  $this->adsRepo->findByAuthAndId($id);
       
        // if ($ads->status == AdsStatus::WAIT || $ads->checkIsPublish()) {
        //     return back()
        //           ->withError(__("qsale::api.ads.not_not_allow_republish"));
        // }

        $republish = $this->repo->republishAdsRequest($package, $ads);

        $url = $republish->payment  ?  $this->adsRepo->getUrlPayment($republish->payment, "frontend-order") : "";
      
        if(!empty($url)) return redirect($url);

        return redirect()->route("frontend.user.my_ads")
                    ->withSuccess(__("qsale::frontend.republished_package.paid_success"));
    }
}
