<?php
namespace Modules\User\Concerns;

use Illuminate\Support\Facades\DB;
use Modules\QSale\Entities\Package;

trait HandleUserSubscriptionAdmin
{
    public function createSubscription(&$model, &$request)
    {
        $package = Package::findOrFail($request->input("package_id"));
        $subscription = $model->subscriptions()->updateOrCreate(
            ["user_id"=> $model->id, "package_id"=> $package->id],
            $this->handleDataPackage($package, $request)
        );
        if (!$subscription->wasRecentlyCreated) {
            $subscription->update(["renewal_count"=> $subscription->renewal_count +1, "renewal_at"=>now()]);
        }
    }

    public function updateDefaultSubscription(&$model, &$request)
    {
        $package = Package::findOrFail($request->input("package_id"));
        $model->subscriptions()->updateOrCreate(["user_id"=> $model->id, "is_default"=> true], $this->handleDataPackage($package, $request));
    }


    public function handleDataPackage(&$package, &$request)
    {
        $date = now();
        $data = [
            "is_paied"        => true ,
            "is_free"         => $package->is_free,
            "is_default"      =>true ,
            "start_at"        => $date ,
            "end_at"          => $date->copy()->addDays($package->duration),
            "money"           => $package->price,
            "max_use"         => $package->number_of_ads,
            "duration_of_ads" => $package->duration_of_ads,
            "package_id"      => $package->id,

        ];
       
        if (!$request->use_pakcage_info  && is_array($request->subscription)) {
            $data = array_merge($data, $request->subscription);
        }
        return $data;
    }


    public function renwal(&$user)
    {
        DB::beginTransaction();
        $package = $user->currentSubscription->package;
        $date = now();
        try {
            $data = [
                "current_use"     => 0,
                "is_default"      =>true ,
                "start_at"        => $date ,
                "end_at"          => $date->copy()->addDays($package->duration),
                "money"           => $package->price,
                "max_use"         => $package->number_of_ads,
                "duration_of_ads" => $package->duration_of_ads,
                "renewal_count"   => $user->currentSubscription->renewal_count +1,
                "renewal_at"      => $date
    
            ];

            $user->currentSubscription->update($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function updateSubscription($user, $request, $skip_have_condition= false)
    {
        $subscription = $user->currentSubscription;

        if ($request->have_subscription || $skip_have_condition) {
            // check if package change
           
            if (optional($subscription)->package_id != $request->input("package_id")) {
                $user->subscriptions()
                     ->where("is_default", true)->update(["is_default"=> false]);
                $this->createSubscription($user, $request);

            } elseif (optional($subscription)->package_id == $request->input("package_id")) { // still current package
                $this->updateDefaultSubscription($user, $request);
            }
        } else {
            if ($subscription) {
                $user->currentSubscription->update(["is_default"=> false]);
            }
        }
    }
}
