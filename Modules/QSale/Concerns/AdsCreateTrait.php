<?php
namespace Modules\QSale\Concerns;

use Modules\QSale\Enum\AdsType;
use Modules\QSale\Enum\AdsStatus;
use Illuminate\Support\Facades\DB;
use Modules\QSale\Entities\Addation;

/**
 * Contain main method to handle ads create and update
 */
trait AdsCreateTrait
{
    // handle data
    public function handelDataForAds(&$user, $request)
    {
        $number_of_free = setting("other", "number_of_free") ?? 0;
        $data  = [
            "duration"      => 0,
            "office_id"     => optional($user->office)->id,
            "user_id"       => $user->id,
            "is_paid"       => false,
            "type"          => AdsType::NORMAL ,
            "addation_total"=> 0,
            "ads_price"     => 0,
            "total"         => 0,
            "subscription_id"=> null,
        ];

        // First check if the allow free;
        if ($user->number_of_free < $number_of_free) {
            $data["type"]       = AdsType::FREE;
            $data["duration"]   = setting("other", "default_duration") ?? 3;
        } else {  // Handle normal or office

            if ( //Check if user is office and currentSubscription is allow to use
                $user->type == "office" &&
                $user->currentSubscription &&
                $user->currentSubscription->checkAllowUse()
                ) {
                $data["type"]               = AdsType::SUBSCRIPTION;
                $data["duration"]           =  $user->currentSubscription->duration_of_ads;
                $data["subscription_id"]    = $user->currentSubscription->id;
            } else {
                $data["duration"]   = setting("other", "default_duration") ?? 3;
                $data["ads_price"]  = getNumberOfCoinsForAdByUserType($user) ?? 3;
                $data["total"]      = $data["ads_price"];
            }
        }


        return $data;
    }


    // update or create
    public function updateOrCreateAds($data, &$user = null)
    {
        $model = $this->model->where(
            [ "status"=>AdsStatus::WAIT, "is_paid"=> false ]
        )->first();

                  
        if ($model) {
            $model->handleUndoUserSubscription($user);
            $model->update($data);
            $model->clearMediaCollection("attachs");
            $model->attributes()->delete();
            $model->addations()->delete();
            $model->address()->delete();
        } else {
            $model = $this->model->create($data);
        }
      
        return $model;
    }

    // upload attach
    public function uploadAttach(&$model, $request, $is_create=false)
    {
        if ($request->image) {
            $model->clearMediaCollection("default_image");
            $model->addMediaFromRequest("image")->toMediaCollection('default_image');
        }
        // if (!$request->image && $is_create) {
        //     $model->addMedia(public_path("/uploads/default.png"))->toMediaCollection('default_image');
        // }
        if (is_array($request->attachs)) {
            foreach ($request->attachs as $attach) {
                # code...
                $model->addMedia($attach)->toMediaCollection('attachs');
            }
        }
    }

    // handle update attribute .
    public function handleOrUpdateAttribute(&$model, &$request)
    {
        if (is_array($request->adsAttributes)) {
            foreach ($request->adsAttributes as $attribute) {
                $x =$model->attributes()
                        ->updateOrCreate(
                            [
                                    "ads_id"=>$model->id,
                                    "attribute_id"=> optional($attribute)["attribute_id"]
                                ],
                            $attribute
                        );
            }
        }
    
        return $model;
    }

    // handle additions
    public function handleAddations(&$model, &$request)
    {
        if (is_array($request->addations)) {
            $addations = Addation::active()
                            ->whereIn("id", $request->addations)->get();
            $total = 0;
            foreach ($addations as $addation) {
                $total +=  $addation->price;
                $model->addations()->create([
                "addation_id"  => $addation->id ,
                 "price"       => $addation->price,
              ]);
            }
            $model->update(["addation_total" =>$total, "total"=> $model->total + $total]);
        };

        return $model;
    }

    // create address
    public function createAddress(&$model, &$request)
    {
        if (is_array($request->address)) {
            $country_id = config("customs.country_id");
            foreach ($request->address as $address) {
                $model->address()
                        ->updateOrCreate(
                            [
                                    "ads_id"=> $model->ads_id,
                                    "city_id"=> isset($address["city_id"]) ? $address["city_id"] : null,
                                    "state_id"=> isset($address["state_id"]) ?  $address["state_id"] : null,
                                    "country_id"=>isset($address["country_id"]) ? $address["country_id"] : $country_id
                                ]
                        );
            }
        }
    }

    // delete old attribute and addation for update
    public function deleteOldAtributeAndAddaionForUpdate(&$model, &$request)
    {
        //delete old attibutes
        $model->attributes()->delete();
        $model->address()->delete();
        $addations = $model->addations()->get();
        foreach ($addations as $addation) {
            $model->removeAddation($addation);
        }
    }

    // delete media in request
    public function deleteMediaInRequest(&$model, &$request)
    {
        if (is_array($request->deleteMedia)) {
            foreach ($request->deleteMedia as $idMedia) {
                # code...
                $model->deleteMedia($idMedia);
            }
        }
    }

    public function decrimentCoins($ads)
    {
        $user =  request()->user();
        $userCoinsBlance = $user->coins;

        $cutCoins = 0;
        if( $userCoinsBlance->balance_after > $ads->total )
        {
            $cutCoins = $userCoinsBlance->balance_after - $ads->total;
        }

        $user->coinsTransactions()->create([
            "balance_before" => $userCoinsBlance->balance_after,
            "coins_number" => - $ads->total,
            "balance_after" =>  $cutCoins,
            "data" =>[
                "type" => "ad",
                "ads_id" => $ads->id,
            ],
        ]);
    }

    // create payment request or 
    public function paymentHandler(&$model)
    {
        DB::beginTransaction();
        try {
            $payment = null;
            if ($model->total > 0) {
                $payment = $this->decrimentCoins($model);
                $model->is_paid = true;
                $model->save();
                $model->confirm();
            } else {
                $model->confirm();
            }

            DB::commit();
            return $payment;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function getUrlPayment(&$payment, $type ="api-order", $payment_type = "knet" )
    {
        $payment->loadMissing("user");

        
        
        if ($payment) {
            return $this->payment->getResultForPayment($payment, $type, $payment_type);
        }
        return "";
    }

}
