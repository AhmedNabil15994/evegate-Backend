<?php

namespace Modules\Slider\Repositories\Dashboard;

use DB;
use Modules\QSale\Entities\Ads;
use Modules\Slider\Entities\Slider;

class SliderRepository
{
    public function __construct(Slider $slider)
    {
        $this->slider   = $slider;
    }

    public function getAll()
    {
        $Slider = $this->slider->get();
        return $Slider;
    }

    public function findById($id)
    {
        $Slider = $this->slider->withDeleted()->find($id);
        return $Slider;
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
            $image = $request['image'] ? pathFileInStorage($request, "image", "sliders")  :  "/uploads/default.png";
            $start = $request->start_at;
            $end = $request->end_at;

            if ($request->type == "in") {
                $ads =  Ads::allowShow()->where("id", $request->ads_id)->firstOrFail();
                $start = $ads->start_at ?? $start;
                $end   = $ads->end_at ?? $end;
            }

            $Slider = $this->slider->create([
                'start_at'      => $start,
                'end_at'        => $end,
                'link'          => $request->link ?? "#",
                'image'         => $image,
                "info"          => $request->info,
                "type"          => $request->type,
                "ads_id"        => $request->ads_id,
                'status'        => $request->status ? 1 : 0,
                "position"      => $request->position,
            ]);


            if ($request->categories && count($request->categories) > 0) {
                $Slider->categories()->sync($request->categories);
            }

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

        $Slider = $this->findById($id);
        $restore = $request->restore ? $this->restoreSoftDelte($Slider) : null;
        $image =  $Slider->image;
        if ($request->image) {
            deleteFileInStroage($Slider->image);
            $image = pathFileInStorage($request, "image", "users");
        }

        $start = $request->start_at;
        $end = $request->end_at;

        if ($request->type == "in") {
            $ads =  Ads::allowShow()->where("id", $request->ads_id)->firstOrFail();
            $start = $ads->start_at ?? $start;
            $end   = $ads->end_at ?? $end;
        }



        try {
            $Slider->update([
                'start_at'      => $start,
                'end_at'        => $end,
                'link'          => $request->link,
                'image'         => $image,
                'status'        => $request->status ? 1 : 0,
                "info"          => $request->info,
                "type"          => $request->type,
                "ads_id"        => $request->ads_id,
                "position"      => $request->position,

            ]);


            $Slider->categories()->sync($request->categories && count($request->categories) ? $request->categories  : []);

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
            foreach ($request['ids'] as $id) {
                $model = $this->delete($id);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function QueryTable($request)
    {
        $query = $this->slider->query();


        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable(&$query, $request)
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

        if (isset($request['req']['position']) && $request['req']['position'] != '') {
            $query->where("position", $request['req']['position']);
        }

        return $query;
    }
}
