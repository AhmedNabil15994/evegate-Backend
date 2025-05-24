<?php

namespace Modules\QSale\Repositories\Frontend;

use DB;
use Hash;
use Modules\QSale\Enum\AdsType;
use Modules\QSale\Enum\AdsStatus;
use Modules\QSale\Entities\Addation;
use Modules\QSale\Enum\AddationType;
use Modules\QSale\Entities\Ads  as Model;
use Modules\QSale\Concerns\AdsCreateTrait;
use Modules\Core\Packages\Payment\Contract\PaymentInterface;

class AdsRepository
{
    use AdsCreateTrait;
    public function __construct(Model $model, PaymentInterface $payment)
    {
        $this->model    = $model;
        $this->payment  = $payment;
    }

    public function findById($id, $with=[])
    {
        return $this->model->where("id", $id)->with($with)->firstOrFail();
    }

    public function adsCount()
    {
        return $this->model->count();
    }

    public function findBySlug($slug, $with=[], $withCount=[])
    {
        return $this->model->where("slug", $slug)
                    ->orWhere("id", $slug)
                    ->with($with)
                    ->when(auth()->check(), fn ($query) =>$query->isFavourit(auth()->id()))
                    ->withCount($withCount)
                    ->firstOrFail();
    }

    public function listActive($request, $with=["media"])
    {
        // dd("hi");
        return $this->model
                    ->allowShow()
                    //  ->withIsType()
                    ->searchBase($request)
                    ->categorySlugFilter($request)
                    ->priceFilter($request)
                    ->sortBasedType(AddationType::NORMAL)
                    ->sortFilter($request)
                    ->addressFilter($request)
                    ->when(auth()->check(), fn ($query) =>$query->isFavourit(auth()->id()))
                    ->latest()
                    ->with($with)
                    ->paginate($request->page_count ?? config("app.page_count", 15));
    }

    public function findByAuthAndId($id, $with=[])
    {
        return $this->model
                    ->authTenant()
                    ->where("id", $id)
                    ->with($with)
                    ->firstOrFail();
    }

    public function listAdsMe($request, $with=["media"])
    {
        return $this->model->authTenant()
                    ->with($with)
                    ->paginate($request->page_count ?? config("app.page_count", 15));
    }



    public function listAdsRecommend($with=["media", "addationsModel"], $take=4)
    {
        return $this->model
                    ->allowShow()
                    // ->withCount("userFavorites")
                    // ->whereIn("id", [7,8,9,10])
                    ->sortBasedType(AddationType::NORMAL)
                    ->when(auth()->check(), fn ($query) =>$query->isFavourit(auth()->id()))
                    ->with($with)
                    ->take($take)
                    ->get();
        ;
    }

    



    public function store(&$request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();
            $user     = auth()->user();
            $user->load("office", "currentSubscription.package");
            $data     = array_merge($validated, $this->handelDataForAds($user, $request));
           
            $model = $this->updateOrCreateAds($data, $user);

            if (!in_array($model->type, [AdsType::NORMAL])) {
                $model->handleUserSubscription($user);
            }

            $this->uploadAttach($model, $request, true);
            $this->handleOrUpdateAttribute($model, $request);
            $this->handleAddations($model, $request);
            $this->createAddress($model, $request);
            

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
            $model->address()->delete();
            $model->update($data);
            $this->uploadAttach($model, $request);
            $this->deleteMediaInRequest($model, $request);
            $this->createAddress($model, $request);
            $model->adTypes()->sync($request->ad_types ?? []);
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
