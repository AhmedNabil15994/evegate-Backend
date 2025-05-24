<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;

use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Core\Packages\Payment\TapPaymentService;
use Modules\QSale\Repositories\Api\PackageRepository;
use Modules\QSale\Transformers\Api\SubscriptionResource;
use Modules\QSale\Repositories\Api\SubscriptionRepository as Repo;

class SubscriptionController extends ApiController
{
    public $repo;
    public $packageRepo;
    public function __construct(Repo $repo, PackageRepository $packageRepo)
    {
        $this->repo = $repo;
        $this->packageRepo = $packageRepo;
    }


    public function current(Request $request)
    {
        $subscription = $this->repo->getCurrent(["package"]);
        return $this->response(
            $subscription ? new SubscriptionResource($subscription) : null
        );
    }


    public function me(Request $request)
    {
        $subscriptions = $this->repo->getListMe(["package"]);
        return $this->responsePagnation(
            SubscriptionResource::collection($subscriptions)
        );
    }

    public function markDefault(Request $request, $id)
    {
        $subscription = $this->repo->findByAuthId($id);
        if (!$subscription->is_default) {
            $this->repo->markAsDefault($subscription);
        }
        return $this->response(
            new SubscriptionResource($subscription)
        );
    }

    public function renewal(Request $request, $id)
    {
        $subscription = $this->repo->findByAuthId($id);
        $subscription = $this->repo->renewal($subscription);

        return $this->response([
            "subscription" => new SubscriptionResource($subscription),
            "url"         =>  $subscription->money > 0 &&  $subscription->payment  ? $this->repo->getUrlPayment($subscription->payment)   : ""
        ]);
    }


    public function subscriptionPackage(Request $request, $id)
    {
        $package = $this->packageRepo->findById($id, []);

        $subscription = $this->repo->createSubscription($package);


        // dd((new TapPaymentService())->send($subscription->payment));
        return $this->response([
            "subscription" => new SubscriptionResource($subscription),
            "url"         =>  $subscription->money > 0 &&  $subscription->payment  ? $this->repo->getUrlPayment($subscription->payment)   : ""
        ]);
    }
}
