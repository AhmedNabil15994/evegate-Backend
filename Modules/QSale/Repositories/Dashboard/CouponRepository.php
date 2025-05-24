<?php

namespace Modules\QSale\Repositories\Dashboard;

use Hash;
use Illuminate\Support\Facades\DB;
use Modules\QSale\Entities\Coupon;

class CouponRepository
{
    public function __construct(Coupon $model)
    {
        $this->model   = $model;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $models = $this->model->active()->orderBy($order, $sort)->get();
        return $models;
    }

    public function getStatistics()
    {
        $count  = $this->model->count();
        return ["count" => $count];
    }


    public function getAll($order = 'id', $sort = 'desc')
    {
        $models = $this->model->orderBy($order, $sort)->get();
        return $models;
    }

    public function findById($id)
    {
        $model = $this->model->find($id);
        return $model;
    }

    public function create($request)
    {

        DB::beginTransaction();

        try {
            $data =  array_merge(
                $request->validated(),
                [
                    "status" => $request->status  ? 1 : 0,
                    "is_fixed" => $request->is_fixed ? 1 : 0
                ]
            );
            $model = $this->model->create($data);

            $model->packages()->sync($data['packages']);

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

        $data =  array_merge(
            $request->validated(),
            [
                "status" => $request->status  ? 1 : 0,
                "is_fixed" => $request->is_fixed ? 1 : 0
            ]
        );



        try {
            $model->update($data);
            $model->packages()->sync($data['packages']);
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
            $model->delete();


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
        $query = $this->model->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%')
                ->orWhere("code", 'like', '%' . $request->input('search.value') . '%');
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        // Search Coupons by Created Dates
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



        return $query;
    }
}
