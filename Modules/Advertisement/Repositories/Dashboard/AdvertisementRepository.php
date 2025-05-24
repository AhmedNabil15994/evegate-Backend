<?php

namespace Modules\Advertisement\Repositories\Dashboard;

use DB;
use Modules\QSale\Entities\Ads;
use Modules\Advertisement\Entities\Advertisement as Model;

class AdvertisementRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

    public function findById($id)
    {
        $model = $this->model->withDeleted()->find($id);
        return $model;
    }

    public function getAdsToSlide()
    {
        $ads =  Ads::select(["id", "title", "status", "is_paid", "user_id", "start_at", "end_at"])
            ->allowShow()->get();
        return $ads;
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {
            $image = $request['image'] ? pathFileInStorage($request, "image", "advertisements")  : "/uploads/default.png";
            $start = $request->start_at;
            $end = $request->end_at;

            if ($request->type == "in") {
                $ads =  Ads::allowShow()->where("id", $request->ads_id)->firstOrFail();
                $start = $ads->start_at ?? $start;
                $end   = $ads->end_at ?? $end;
            }

            $model = $this->model->create([
                'start_at'      => $start,
                'end_at'        => $end,
                'link'          => $request->link ?? "#",
                'image'         => $image,
                "info"          => $request->info,
                "type"          => $request->type,
                "ads_id"        => $request->ads_id,
                'status'        => $request->status ? 1 : 0,

            ]);

            DB::commit();
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
        $image =  $model->image;
        if ($request->image) {
            deleteFileInStroage($model->image);
            $image = pathFileInStorage($request, "image", "advertisements");
        }

        $start = $request->start_at;
        $end = $request->end_at;

        if ($request->type == "in") {
            $ads =  Ads::allowShow()->where("id", $request->ads_id)->firstOrFail();
            $start = $ads->start_at ?? $start;
            $end   = $ads->end_at ?? $end;
        }



        try {
            $model->update([
                'start_at'      => $start,
                'end_at'        => $end,
                'link'          => $request->link,
                'image'         => $image,
                'status'        => $request->status ? 1 : 0,
                "info"          => $request->info,
                "type"          => $request->type,
                "ads_id"        => $request->ads_id,
            ]);

            DB::commit();
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
                $model->forceDelete();
            else :
                $model->delete();
            endif;

            DB::commit();
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
            if (is_array($request['ids'])) {
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
        $query = $this->model;

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        // SEARCHING INPUT DATATABLE
        if ($request->input('search.value') != null) {
            $query = $query->where(function ($query) use ($request) {
                $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            });
        }

        // FILTER
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

        if (isset($request['req']['status']) &&  $request['req']['status'] == '1') {
            $query->active();
        }

        if (isset($request['req']['status']) &&  $request['req']['status'] == '0') {
            $query->unactive();
        }

        return $query;
    }
}
