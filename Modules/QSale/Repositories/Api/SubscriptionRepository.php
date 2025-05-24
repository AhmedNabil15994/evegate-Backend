<?php

namespace Modules\QSale\Repositories\Api;

use File;
use Illuminate\Log\Logger;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Modules\QSale\Entities\Coupon;
use Modules\Qsale\Events\PaiedEvent;
use Modules\QSale\Entities\Subscription as Model;
use Modules\Core\Packages\Payment\Contract\PaymentInterface;

class SubscriptionRepository
{
    public function __construct(Model $model, PaymentInterface $payment)
    {
        $this->model    = $model;
        $this->payment  = $payment;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
    }



    public function findById($id, $with = [])
    {
        return $this->model->with($with)
            ->where('id', $id)
            ->where("status", "wait")
            ->first();
    }

    public function findByAuthId($id, $with = [])
    {
        return $this->model->with($with)
            ->authTenant()
            ->where('id', $id)
            ->firstOrFail();
    }

    public function getCurrent($with = [])
    {
        return $this->model->authTenant()
            ->where("is_default", true)
            ->with($with)
            ->first();
    }

    public function getSubscriptionForPackage($package_id)
    {
        return $this->model->authTenant()
            ->where("package_id", $package_id)
            ->first();
    }

    public function getListMe($with = [])
    {

        return $this->model
            ->unexpired()
            ->authTenant()
            ->with($with)
            ->latest("is_default")
            ->where("is_paied", 1)
            ->paginate(request()->page_count ?? config("app.page_count", 15));
    }


    public function createSubscription(&$package)
    {

        DB::beginTransaction();
        try {
            $subscription = $this->getSubscriptionForPackage($package->id);



            $user = auth()->user();
            if (!$subscription) {
                $data = [
                    "is_default" => false,
                    "money"      => $package->price,
                    "is_free"    => $package->price > 0,
                    "is_paied"    => $package->price == 0,
                    "package_id"  => $package->id,
                    "original_money"  => $package->price,

                ];
                $subscription = $user->subscriptions()->create($data);
            } else {
                $subscription->update(["money" => $package->price]);
            }


            if (
                (request()->code && $coupon = Coupon::validCoupon(request()->code)->first()) && ($subscription->is_free)

            ) {
                $subscription->update([
                    'money' => ($subscription->money - $coupon->applyCoupon($subscription->money))
                ]);

                $subscription->coupons()->create([
                    'code' => $coupon->code,
                    'discount_type' => $coupon->is_fixed ? 'value' : 'percentage',
                    'discount_percentage' =>
                    $subscription->original_money > 0 ? (1 - ($subscription->money / $subscription->original_money)) * 100 : null,
                    'discount_value' =>  $subscription->original_money - $subscription->money,
                    'coupon_id' => $coupon->id,
                ]);
            }

            if ($subscription->money > 0) {
                $payment = $this->paymentHandler($subscription);
                $subscription->loadMissing("payment.user");
            } else {
                $subscription->confirm();
            }
            DB::commit();
            return $subscription;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function markAsDefault(&$subscription)
    {
        DB::beginTransaction();
        try {
            $subscription->update(["is_default" => 1]);
            $this->model->where("user_id", $subscription->user_id)
                ->where("id", "!=", $subscription->id)
                ->update(["is_default" => 0]);
            DB::commit();
            return $subscription;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function renewal(&$subscription)
    {
        DB::beginTransaction();
        try {
            $package = $subscription->package;
            $subscription->update(["money" => $package->price]);

            if ($subscription->money > 0) {
                $payment = $this->paymentHandler($subscription);
                $subscription->loadMissing("payment.user");
            } else {
                $subscription->confirm();
            }

            DB::commit();
            return $subscription;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function paymentHandler(&$model)
    {
        $payment = $model->payments()->updateOrCreate([
            "status" => "wait"
        ], [
            "owner" => auth()->user(),
            "total" => $model->money,
            "user_id" => auth()->id(),
        ]);

        return $payment;
    }


    public function getUrlPayment($payment)
    {
        $payment->loadMissing("user");


        if ($payment) {
            return $this->payment->getResultForPayment($payment);
        }
        return "";
    }
}
