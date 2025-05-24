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
use Modules\QSale\Entities\Ads;
use Modules\QSale\Entities\AdsAddation as model;
use Modules\QSale\Entities\AdsAddation;

class AdsAddationRepository
{
    public function __construct(model $model)
    {
        $this->model   = $model;
    }

    public function create($request, $ads)
    {
        DB::beginTransaction();
        try {

            $addation = Addation::find($request->addation_id);

            AdsAddation::create([
                "addation_id"  => $addation->id,
                "price"        => $addation->price,
                "ads_id"        => $ads->id
            ]);
            DB::commit();
            Cache::forget("ads");
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update($request, $ads)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            foreach ($data['addations'] as $key => $adsAddation) {
                AdsAddation::where(['ads_id' => $ads->id, 'addation_id' => $adsAddation['addation_id']])->update([
                    'start_date' => $adsAddation['start_date'],
                    'expire_date' => $adsAddation['expire_date']
                ]);
            }
            DB::commit();
            Cache::forget("ads");
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
