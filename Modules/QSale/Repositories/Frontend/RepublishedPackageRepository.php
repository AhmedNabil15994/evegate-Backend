<?php

namespace Modules\QSale\Repositories\Frontend;

use DB;
use Hash;
use Modules\QSale\Entities\RepublishedPackage  as Model;
use Modules\Core\Packages\Payment\Contract\PaymentInterface;

class RepublishedPackageRepository
{
    public function __construct(Model $model, PaymentInterface $payment)
    {
        $this->model    = $model;
        $this->payment  = $payment;
    }

  


    public function getAll(&$request, $order = 'id', $sort = 'desc')
    {
        $models = $this->model->active()->orderBy($order, $sort)
                        ->get()
                    //  ->paginate($request->page_count ?? env("PAGE_COUNT", 15))
                     ;
        return $models;
    }

    public function findById($id, $with=[])
    {
        $model = $this->model->with($with)->findOrFail($id);
        return $model;
    }


    public function republishAdsRequest($package, $ads)
    {
        DB::beginTransaction();
        try {
            $republish = $ads->republishes()
                             ->updateOrCreate(
                                 ["ads_id" => $ads->id, "is_paid"=>0],
                                 [
                                     "duration" => $package->duration ,
                                     "total"    => $package->price ,
                                     "is_free"  => $package->is_free,
                                     "republished_package_id"=> $package->id ,
                                     "is_paid"  => $package->is_free
                                 ]
                             );

            if (!$republish->is_free) {
                $payment = $this->paymentHandler($republish);
                $republish->payment = $payment;
                $republish->loadMissing("payment.user");
            } else {
                $republish->confirm($ads);
            }
           
            DB::commit();
            return $republish;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function paymentHandler(&$adsRepublished)
    {
        $payment = $adsRepublished->payment()->updateOrCreate([
            "status" => "wait"
        ], [
            "owner"=> auth()->user() ,
            "total" => $adsRepublished->total ,
            "user_id"=> auth()->id(),
        ]);
       
        return $payment;
    }
}
