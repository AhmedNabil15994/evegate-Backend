<?php

namespace Modules\QSale\Repositories\Frontend;

use File;
use Modules\QSale\Entities\Ads;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Modules\QSale\Entities\AdsOrder;
use Modules\QSale\Events\PaiedEvent;
use Modules\QSale\Entities\Subscription;
use Modules\QSale\Entities\AdsRepublished;
use Modules\QSale\Entities\Payment as Model;
use Modules\Core\Packages\Payment\Contract\PaymentInterface;

class PaymentRepository
{
    public function __construct(Model $model, PaymentInterface $payment)
    {
        $this->model   = $model;
        $this->payment  = $payment;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
    }


    public function getTransaction($id)
    {
        return $this->payment->getTransactionDetails($id);
    }


    public function findById($id, $with=[])
    {
        return $this->model->with($with)
                   ->where('id', $id)
                   ->where("status", "wait")
                   ->first();
    }





    public function successPayment($request, $gateway="knet")
    {
        DB::beginTransaction();
        if ($gateway == "knet") {
            $payment = $this->findById($request->OrderID, "order");
            $data    = $request->all();
        } elseif ($gateway == "myfatoorah") {
            $payment = $this->findById($request["UserDefinedField"], "order");
            $data    = $request;
        }


        abort_if(is_null($payment), "404");
        try {
            $payment->update([
                "status" => "paied",
                "transaction"=> $data
            ]);

            $order = $payment->order ;
            $type = "ads";
            if ($order instanceof Ads) {
                $this->handleSuccessAds($payment, $order);
            }

            if ($order instanceof AdsOrder) {
                $this->handleSuccessAdsOrder($payment, $order);
                $type = "addition";
            }

            if ($order instanceof AdsRepublished) {
                $order->loadMissing("ads");
                abort_if(!$order->ads, "404");
                $this->handleSuccessAdsRepublish($payment, $order);
                $type = "republished";
            }

            if ($order instanceof Subscription) {
                $order->loadMissing("package");
                abort_if(!$order->package, "404");
                $this->handleSuccessSubscription($payment, $order);
                $type = "subscription";
            }

            DB::commit();
            event(new PaiedEvent($payment));
            return $type;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function failedPayment($request, $gateway="knet")
    {
        // return null;
        abort_if(is_null($payment), "404");

        if ($gateway == "knet") {
            $payment = $this->findById($request->OrderID, "order");
        } elseif ($gateway == "myfatoorah") {
            $payment = $this->findById($request["UserDefinedField"], "order");
        }

        $type = "ads";

        if (method_exists($order, "attachs")) {
            $order->attachs()->delete();
        }
        $order->forceDelete();

        if ($order instanceof AdsOrder) {
            $type = "addition";
        }

        if ($order instanceof AdsRepublished) {
            $type = "republished";
        }

        if ($order instanceof Subscription) {
            $type = "subscription";
        }


        return $type;

        DB::beginTransaction();
        try {
            $payment->delete();
            $order = $payment->order ;



            DB::commit();
            return $type;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function handleSuccessAds(&$payment, &$ads)
    {
        if ($ads) {
            $ads->confirm();
        }
    }

    public function handleSuccessAdsOrder(&$payment, &$adsOrder)
    {
        if ($adsOrder) {
            $adsOrder->confirm($adsOrder->ads);
        }
    }

    public function handleSuccessAdsRepublish(&$payment, &$republish)
    {
        if ($republish) {
            $republish->confirm($republish->ads);
        }
    }

    public function handleSuccessSubscription(&$payment, &$subscription)
    {
        if ($subscription) {
            $subscription->confirm($payment);
        }
    }
}
