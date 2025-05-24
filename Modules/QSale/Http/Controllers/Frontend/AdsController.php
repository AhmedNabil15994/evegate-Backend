<?php
namespace Modules\QSale\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Modules\QSale\Entities\Ads;
use Modules\QSale\Enum\AdsStatus;
use Illuminate\Routing\Controller;
use Modules\QSale\Http\Requests\Frontend\AdsRequest;
use Modules\QSale\Repositories\Frontend\AdsRepository;
use Modules\QSale\Repositories\Api\AdsRepository as Repo;
use Modules\QSale\Http\Requests\Frontend\AdsUpdateRequest;

class AdsController extends Controller
{
    public function __construct(AdsRepository $repo)
    {
        $this->repo = $repo;
    }

    
    public function show(Request $request, $slug)
    {
        $ads = $this->repo->findBySlug(
            $slug,
            ["category.ancestors",
                 "user"=>fn ($query) =>$query->withCount([
                                "ads"=>fn ($adsQuery) =>$adsQuery->allowShow()
                            ]),
                 "addationsModel", "attributes"
                ]
        );

        $ads->increment("view", 1);
        return view("qsale::frontend.show", compact("ads"));
    }


    public function index(Request $request)
    {
        $classGrad = [
            "one_colum"=>"col-sm-12 col-md-12 col-lg-12 col-xl-12",
            "two_colum"=>"col-sm-6 col-md-6 col-lg-6 col-xl-6",
            "three_colum"=>"col-sm-6 col-md-6 col-lg-6 col-xl-4"
        ];

        $grid = $request->grid && isset($classGrad[$request->grid]) ?  $request->grid: "three_colum";
        $classAds = $classGrad[$grid];
        $ads = $this->repo->listActive($request, ["media",  "addationsModel", "attributes"]);
       
        return view("qsale::frontend.index", compact("ads", "classAds", "grid", "request"));
    }

    public function saveAds(AdsRequest $request)
    {
        $ads = $this->repo->store($request);
     
        return redirect()->route("frontend.ads.preview_payment", $ads->id);
    }

    public function previewPayment(Request $request, $id)
    {
        $ads = $this->repo->findById($id, ["office", "subscription", "user","addationsModel"]);
        abort_if($ads->user_id != auth()->id(), "404");
        $payment =  $this->repo->paymentHandler($ads);
        $url = $payment ? $this->repo->getUrlPayment($payment, "frontend-order") : "";
        return view("qsale::frontend.preview-payment", compact("ads", "url"));
    }

    public function editMyAd(AdsUpdateRequest $request, $id)
    {
        $ads = $this->repo->findById($id, ["office", "subscription", "user","addationsModel"]);
        abort_if($ads->user_id != auth()->id(), "404");

        if ($ads->status != AdsStatus::WAIT && !$ads->checkIsPublish()) {
            return  back()->withSuccess(__("qsale::api.ads.not_not_allow_edit"));
        }

        $this->repo->updateAfterCreate($request, $ads);

        return redirect()->route("frontend.user.my_ads")->withSuccess(__("user::frontend.edit_ads.edit_successfully"));
    }
}
