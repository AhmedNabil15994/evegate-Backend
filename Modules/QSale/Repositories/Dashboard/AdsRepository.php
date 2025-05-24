<?php

namespace Modules\QSale\Repositories\Dashboard;

use Hash;
use Carbon\Carbon;
use Modules\QSale\Enum\AdsType;
use Modules\User\Entities\User;
use Modules\QSale\Enum\AdsStatus;
use Illuminate\Support\Facades\DB;
use Modules\QSale\Entities\Addation;
use Illuminate\Support\Facades\Cache;
use Modules\QSale\Entities\Ads  as Model;

class AdsRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }


    public function getStatistics()
    {
        $data["transform_dates"] = $this->model->where("is_paid", true)
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as dates"))
            ->groupBy('dates')
            ->pluck('dates');
        $transformPaided = $this->model->where("is_paid", true)
            ->where("type", "!=", AdsType::FREE)
            ->selectRaw("count(id) as count_paied")
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();
        $transformFree = $this->model->where("is_paid", true)
            ->where("type", AdsType::FREE)
            ->selectRaw("count(id) as count_free")
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();
        $count  = $this->model->where("is_paid", true)->count();
        $total  =  $this->model->where("is_paid", true)->sum("total");
        $count_free =  $this->model->where("is_paid", true)
            ->where("type", AdsType::FREE)->count();

        $data["transformPaided"] = json_encode($transformPaided->pluck("count_paied")->toArray());
        $data["transformFree"]   = json_encode($transformFree->pluck("count_free")->toArray());


        return ["count" => $count, "total" => $total, "count_free" => $count_free, "graph_count" => $data];
    }


    public function getAll($order = 'id', $sort = 'desc')
    {
        $models = $this->model->orderBy($order, $sort)->get();
        return $models;
    }

    public function findById($id, $with = [])
    {
        $model = $this->model->with($with)->withDeleted()->findOrFail($id);
        return $model;
    }

    /*
    * Get All Normal Users Without Roles
    */
    public function getAllSelect2($request, $order = 'id', $sort = 'desc')
    {
        return $this->model
            ->select("id", "title as text", "type")
            ->allowShow()
            ->searchBase($request)->paginate(20);
    }


    public function create($request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $user = User::with(["company", "currentSubscription.package"])->findOrFail($request->user_id);
            $data     = array_merge($data, $this->handelDataForAds($user, $request));
            $data['country_id'] = $request->country_id ?? setting('default_country');
            $model = $this->model->create($data);
            
            if(!$request->sort){
                $model->sort = $model->id;
                $model->save();
            }

            if (!in_array($model->type, [AdsType::NORMAL])) {
                $model->handleUserSubscription($user);
            }

            $this->handleOrUpdateAttribute($model, $request);
            $this->handleAddations($model, $request);
            $this->uploadAttach($model, $request);

            if (is_array($request->ad_types)) {
                $model->adTypes()->attach($request->ad_types);
            }
            $this->createMultipleAddress($model, $request);

            DB::commit();
            Cache::forget("ads");
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }



    public function update($request, $id)
    {
        DB::beginTransaction();

        $model = $this->findById($id);
        $restore = $request->restore ? $this->restoreSoftDelte($model) : null;


        try {
            $data = $request->validated();
            $data["status"] = $this->getStatus($data);
            $data["total"] = $request->ads_price;
            $data["duration"] = ((Carbon::parse($request->end_at))->diff($request->start_at))->d;
            // dd($data);

            if ($model->status == AdsStatus::WAIT) {
                $data["is_paid"] = $request->is_paid ? 1 : 0;
            }
            
            $data['country_id'] = $request->country_id ?? setting('default_country');

            $model->update($data);

            $this->deleteMediaInRequest($model, $request);
            $this->uploadAttach($model, $request);
            $this->deleteOldAtributeAndAddaionForUpdate($model, $request);
            $this->handleOrUpdateAttribute($model, $request);
            $this->handleAddations($model, $request);
            $model->adTypes()->sync($request->ad_types ?? []);
            $this->createMultipleAddress($model, $request);

            DB::commit();
            Cache::forget("ads");
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function restoreSoftDelte($model)
    {
        $model->restore();
    }



    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $model = $this->findById($id);

            if ($model->trashed()) :
                $model->clearMediaCollection("default_image");
                $model->clearMediaCollection("attachs");
                $model->forceDelete();
            else :
                $model->delete();
            endif;

            DB::commit();
            Cache::forget("ads");
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function deleteSelected($request)
    {
        DB::beginTransaction();

        try {
            if (is_array($request->ids)) {
                foreach ($request['ids'] as $id) {
                    $model = $this->delete($id);
                }

                DB::commit();
            }

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function QueryTable($request)
    {
        $query = $this->model->withDeleted()->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere('title', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere('description', 'like', '%' . $request->input('search.value') . '%');
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function ComplaintQueryTable($request, &$ads)
    {
        $query = $ads->complaints()->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere('name', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere('message', 'like', '%' . $request->input('search.value') . '%');
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        // Search Sections by Created Dates
        if (isset($request['req']['from']) && $request['req']['from'] != '') {
            $query->whereDate('created_at', '>=', $request['req']['from']);
        }

        if (isset($request['req']['to']) && $request['req']['to'] != '') {
            $query->whereDate('created_at', '<=', $request['req']['to']);
        }

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'only') {
            $query->onlyDeleted();
        }

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'with') {
            $query->withDeleted();
        }

        if (isset($request['req']['status']) &&  $request['req']['status'] != '') {
            $query->where("status", $request['req']['status']);
        }


        if (isset($request['req']['is_paid']) &&  $request['req']['is_paid'] != '') {
            $query->where("is_paid", $request['req']['is_paid']);
        }

        if (isset($request['req']['type']) &&  $request['req']['type'] != '') {
            $query->where("type", $request['req']['type']);
        }
        if (isset($request['req']['user_type']) &&  $request['req']['user_type'] != '') {
            $query->where("user_type", $request['req']['user_type']);
        }

        return $query;
    }

    public function handelDataForAds(&$user, $request)
    {
        $number_of_free = setting("other", "number_of_free") ?? 0;
        $data  = [
            "duration"      => $request->duration,
            "office_id"     => optional($user->office)->id,
            "user_id"       => $user->id,
            "start_at"      => $request->start_at,
            "end_at"        => null,
            "status"        => $request->status,
            "is_paid"       => true,
            "type"          => AdsType::NORMAL,
            "addation_total" => 0,
            "ads_price"     => $request->ads_price ?? 0,
            "total"         => $request->ads_price,
            "subscription_id" => null,
        ];

        if ($request->take_from_subscription) {
            // First chekc if the allow free;
            // if ($user->number_of_free < $number_of_free) {
            //     $data["type"]       = AdsType::FREE;
            //     $data["duration"]   = setting("other", "default_duration") ?? 3;
            // } else {  // Handle normal or office

            if ( //Check if user is office and currentSubscription is allow to use
                // $user->type == "office" &&
                $user->currentSubscription &&
                $user->currentSubscription->checkAllowUse()
            ) {
                $data["type"]               = AdsType::SUBSCRIPTION;
                $data["duration"]           =  $user->currentSubscription->duration_of_ads;
                $data["subscription_id"]    = $user->currentSubscription->id;
            }
            // }
        }

        $data["end_at"]  = (\Carbon\Carbon::parse($data["start_at"]))->addDays($data["duration"]);

        $data["status"] = $this->getStatus($data);




        return $data;
    }

    public function uploadAttach(&$model, $request)
    {
        if ($request->image) {

            $filename = str_replace($request->image->getClientOriginalExtension(), '', $request->image->getClientOriginalName());
            $filename = \Illuminate\Support\Str::slug($filename).'.'.$request->image->getClientOriginalExtension();

            $model->clearMediaCollection("default_image");
            $model->addMediaFromRequest("image")
            ->usingFileName($filename)
            ->toMediaCollection('default_image');
        }
        if (is_array($request->attachs)) {
            foreach ($request->attachs as $attach) {
                # code...
                $model->addMedia($attach)->toMediaCollection('attachs');
            }
        }
    }

    public function handleOrUpdateAttribute(&$model, &$request)
    {
        if (is_array($request->adsAttributes)) {
            foreach ($request->adsAttributes as $attribute) {
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

    public function getStatus($model)
    {
        if (in_array($model["status"], [AdsStatus::CONFIRM, AdsStatus::PUBLIUSH])) {
            $now = now()->format("Y-m-d");
            $inDate = ($now >= $model["start_at"] && $now <= $model["end_at"]);
            if ($inDate) {
                return AdsStatus::PUBLIUSH;
            }
            return AdsStatus::EXPIRED;
        }
        return AdsStatus::CONFIRM;
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
        if (is_array($request->deleteAttachs)) {
            foreach ($request->deleteAttachs as $idMedia) {
                # code...
                $model->deleteMedia($idMedia);
            }
        }
    }

    public function createAddress(&$model, &$request)
    {
        $model->address()
            ->updateOrCreate(
                [
                    "ads_id" => $model->ads_id, "city_id" => $request["city_id"], "state_id" => $request["state_id"],
                    "country_id" => $request["country_id"]
                ]
            );
    }

    public function createMultipleAddress(&$model, &$request)
    {
        if (is_array($request->address)) {
            foreach ($request->address as $address) {
                # code...
                $model->address()
                    ->updateOrCreate(
                        [
                            "ads_id" => $model->ads_id,
                            "city_id" => isset($address["city_id"]) ? $address["city_id"] : null,
                            "state_id" => isset($address["state_id"]) ? $address["state_id"] : null,
                            "country_id" => isset($address["country_id"]) ? $address["country_id"] : null
                        ]
                    );
            }
        }
    }
}
