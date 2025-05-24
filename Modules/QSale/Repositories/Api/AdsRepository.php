<?php

namespace Modules\QSale\Repositories\Api;

use Hash;
use Modules\QSale\Enum\AdsType;
use Modules\QSale\Concerns\CutCoinsTrait;
use Modules\QSale\Enum\AdsStatus;
use Illuminate\Support\Facades\DB;
use Modules\QSale\Entities\Addation;
use Modules\QSale\Entities\Ads  as Model;
use Modules\QSale\Concerns\AdsCreateTrait;
use Modules\Core\Packages\Meida\CutomMedia;
use Modules\Core\Packages\Payment\Contract\PaymentInterface;

class AdsRepository
{
    use AdsCreateTrait, CutCoinsTrait;

    public function __construct(Model $model, PaymentInterface $payment)
    {
        $this->model    = $model;
        $this->payment  = $payment;
    }

    public function findById($id, $with = [])
    {
        return $this->model
            ->when(auth('api')->check(), fn ($query) => $query->isFavourit(auth('api')->id()))
            ->seen(auth('api')->id())->where("id", $id)->with($with)->firstOrFail();
    }

    public function findByAuthAndId($id, $with = [])
    {
        return $this->model
            ->seen(auth('api')->id())
            ->authTenant()
            ->where("id", $id)
            ->with($with)
            ->when(auth('api')->check(), fn ($query) => $query->isFavourit(auth('api')->id()))

            ->withCount('userFavorites')
            ->firstOrFail();
    }
    public function listAdsMe($request, $with = ["media"])
    {
        return $this->model->authTenant()
            ->with($with)
            ->withCount('userFavorites')
            ->seen(auth('api')->id())
            ->latest("id")
            ->allowShow()
            ->when(auth('api')->check(), fn ($query) => $query->isFavourit(auth('api')->id()))

            ->paginate($request->page_count ?? config("app.page_count", 15));
    }

    public function listActive($request, $with = ["media"])
    {
        $query = $this->model
            ->seen(auth('api')->id())
            ->allowShow()
            ->withCount('userFavorites')
            ->searchBase($request)
            ->addressFilter($request)
            ->categoryFilter($request)
            ->attributeFilter($request)
            ->priceFilter($request)
            ->filterAdType($request)
            ->when(auth('api')->check(), fn ($query) => $query->isFavourit(auth('api')->id()))
            ->when($request->category_id, fn ($query) => $query->where("category_id", $request->category_id))
            ->typeAddationFilter($request)
            ->with($with)
            ->loadUserWithAvg($request);

            $query = $request->sort && $request->sort == "random" ? $query
            ->inRandomOrder()
            ->distinct() : $query->orderBy("sort",'desc');

            return $query->paginate($request->page_count ?? 25);
    }


    public function getRelated(&$ads, $with = [])
    {
        $ids = [];
        if ($ads->category) {
            $category = $ads->category;
            $siblings = $category->siblings()->pluck("id")->toArray();
            $ids = array_merge($siblings, [$category->id]);
        }
        return  $this->model
            ->allowShow()
            ->seen(auth('api')->id())
            ->with($with)
            ->where("id", "!=", $ads->id)
            ->whereIn("category_id", $ids)
            ->withCount('userFavorites')
            ->when(auth('api')->check(), fn ($query) => $query->isFavourit(auth('api')->id()))
            ->limit(6)->get();
    }

    public function createComplaint(&$ads, &$request)
    {
        return  $ads->complaints()->create($request->validated());
    }

    public function store(&$request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();
            $user     = auth()->user();
            $data     = array_merge($validated, $this->handelDataForAds($user, $request));
            $data['country_id'] = $request->country_id ?? auth()->user()->country_id;
            $data['price'] = $request->price ? (double)$request->price : null;
            $data['offer_price'] = $request->offer_price ? (double)$request->offer_price : null;
            $model = $this->updateOrCreateAds($data, $user);

            $model->sort = $model->sort ?? $model->id;
            $model->save();
            $this->uploadAttach($model, $request, true);
            $this->handleOrUpdateAttribute($model, $request);
            $this->handleAddations($model, $request);
            
            $model->adTypes()->sync($request->ad_types ?? []);
            
            //cut ads cost from coins
            // $coinsCost = getNumberOfCoinsForAdByUserType();
            // $addationsTotal = 0;
            // if( $coinsCost > 0 )
            // {
            //     if (is_array($request->addations)) {
            //         $addationsTotal = Addation::active()->whereIn("id", $request->addations)->sum('price');
            //     }
        
            //     $totalCost = $coinsCost + $addationsTotal;

            //     $this->decrimentCoinsNew($totalCost, request()->user(), $model->id);
            // }

            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function confirm($ad)
    {
        //Cut coins from user balance
        $this->decrimentCoinsNew($ad->total, request()->user(), $ad);

        //update is_paid status to true
        // $ad->is_paid = true;
        // $ad->save();
        $ad->confirm();
    }

    public function update(&$request, &$id)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $model    = $this->findByAuthAndId($id);
            $data['country_id'] = $request->country_id ??  auth()->user()->country_id;
            $data['price'] = $request->price ? (double)$request->price : $model->price;
            $data['offer_price'] = $request->offer_price ? (double)$request->offer_price : $model->offer_price;
            $model->update($data);
            $this->uploadAttach($model, $request);
            $this->deleteOldAtributeAndAddaionForUpdate($model, $request);
            $this->handleOrUpdateAttribute($model, $request);
            $this->handleAddations($model, $request);
            $this->deleteMediaInRequest($model, $request);
            
            $model->adTypes()->sync($request->ad_types ?? []);

            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function updateAfterCreate(&$request, &$model)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $model->attributes()->delete();
            $data['country_id'] = $request->country_id ?? setting('default_country');
            $model->update($data);
            $this->uploadAttach($model, $request);
            $this->deleteMediaInRequest($model, $request);
            if (is_array($request->deleteAddress)) {
                $model->address()->whereIn("id", $request->deleteAddress)->delete();
            }
            if (is_array($request->addations) && count($request->addations)  > 0) {
                foreach ($addations as $addation) {
                    $model->removeAddation($addation);
                }
                $this->handleAddations($model, $request);
            }
            
            $model->adTypes()->sync($request->ad_types ?? []);
            $this->handleOrUpdateAttribute($model, $request);
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function delete(&$model)
    {
        DB::beginTransaction();

        try {
            $model->clearMediaCollection("default_image");
            $model->clearMediaCollection("attachs");
            if ($model->is_paid == false && $model->status == AdsStatus::WAIT) {
                $model->handleUndoUserSubscription($model->user);
            }
            $model->delete();

            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function incrementView(&$model)
    {
        return $model->increment("view", 1);
    }

    public function getCurrentForUser($request)
    {
        return $this->model
            ->withCount('userFavorites')
            ->authTenant()
            ->where("status", AdsStatus::WAIT)
            ->where("is_paid", false)
            ->with([
                "addations", "attributes", "country", "city",
                "state"
            ])
            ->first();
    }



    public function uploadAttach(&$model, $request, $is_create = false)
    {
        if ($request->image) {
            $model->clearMediaCollection("default_image");
            $model->addMediaFromRequest("image")->toMediaCollection('default_image');
        }
        if ($request->video) {
            $model->clearMediaCollection("video");
            $model->addMediaFromRequest("video")->toMediaCollection('video');
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


    public function handelDataForAds(&$user, $request)
    {
        $data  = [
            "duration"      => 0,
            "user_type"     => $user->type,
            "user_id"       => $user->id,
            "is_paid"       => false,
            "type"          => AdsType::NORMAL,
            "addation_total" => 0,
            "ads_price"     => 0,
            "total"         => 0,
            "subscription_id" => null,
        ];

        $data["duration"]   = setting("other", "default_duration") ?? 3;
        $data["ads_price"]  = getNumberOfCoinsForAdByUserType();
        $data["total"]      = $data["ads_price"];

        return $data;
    }

    public function handleOrUpdateAttribute(&$model, &$request)
    {
        if (is_array($request->adsAttributes)) {
            foreach ($request->adsAttributes as $attribute) {
                $attribute["option_id"] = $attribute["option_id"] ??   $attribute["optional_id"] ?? null;
                $x = $model->attributes()
                    ->updateOrCreate(
                        [
                            "ads_id" => $model->id,
                            "attribute_id" => optional($attribute)["attribute_id"]
                        ],
                        $attribute
                    );
            }
        }

        return $model;
    }

    public function handleAddations(&$model, &$request)
    {
        if (is_array($request->addations)) {
            $addations = Addation::active()
                ->whereIn("id", $request->addations)->get();
            $total = 0;
            foreach ($addations as $addation) {
                $total +=  $addation->price;
                $model->addations()->create([
                    "addation_id"  => $addation->id,
                    "price"       => $addation->price,
                ]);
            }
            $model->update(["addation_total" => $total, "total" => $model->total + $total]);
        };

        return $model;
    }

    public function updateOrCreateAds($data, &$user = null)
    {
        $model = $this->model->where(
            ["status" => AdsStatus::WAIT, "is_paid" => false]
        )->first();


        if ($model) {
            $model->update($data);
            $model->clearMediaCollection("attachs");
            $model->attributes()->delete();
            $model->addations()->delete();
            $model->address()->delete();
        } else {
            $model = $this->model->create($data);
        }

        $model->refresh();
        return $model;
    }

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

    public function deleteMediaInRequest(&$model, &$request)
    {
        if (is_array($request->deleteMedia)) {
            foreach ($request->deleteMedia as $idMedia) {
                if(CutomMedia::where("model_id",$model->id)->find($idMedia)){

                    # code...
                    $model->deleteMedia($idMedia);
                }
            }
        }
    }

    public function createAddress(&$model, &$request)
    {
        if (is_array($request->address)) {
            $country_id = config("customs.country_id");
            foreach ($request->address as $address) {
                $model->address()
                    ->updateOrCreate(
                        [
                            "ads_id" => $model->ads_id,
                            "country_id" => $request->country_id ?? $country_id
                        ]
                    );
            }
        }
    }

    public  function checkCompanyCantAddAds()
    {
        $user = auth()->user();

        return !($user->currentSubscription && $user->currentSubscription->checkAllowUse()) && auth()->user()->type == 'company';
    }
}
