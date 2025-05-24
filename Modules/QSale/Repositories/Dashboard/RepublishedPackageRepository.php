<?php

namespace Modules\QSale\Repositories\Dashboard;

use DB;
use Hash;
use Illuminate\Support\Facades\Cache;
use Modules\QSale\Entities\RepublishedPackage  as Model;

class RepublishedPackageRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $models = Cache::rememberForever('republished-packages', function () use ($order, $sort) {
            return $this->model->active()->orderBy($order, $sort)->get();
        });
        return $models;
    }

    public function getStatistics()
    {
        $count  =$this->model->count();
        return ["count" => $count];
    }


    public function getAll($order = 'id', $sort = 'desc')
    {
        $models = $this->model->orderBy($order, $sort)->get();
        return $models;
    }

    public function findById($id, $with=[])
    {
        $model = $this->model->with($with)->withDeleted()->findOrFail($id);
        return $model;
    }


    public function create($request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data = array_merge($data, [
                "status"   => $request->status ?  1 : 0 ,
                "is_free"  => $request->is_free ? 1 : 0
            ]);
            $model = $this->model->create($data);

            DB::commit();
            Cache::forget("republished-packages");
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
            $data = array_merge($data, [
                "status"   => $request->status ?  1 : 0 ,
                "is_free"  => $request->is_free ? 1 : 0
            ]);
            
            $model->update($data);
            

            DB::commit();
            Cache::forget("republished-packages");
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

            if ($model->trashed()):
          
            $model->forceDelete(); else:
              $model->delete();
            endif;

            DB::commit();
            Cache::forget("republished-packages");
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
            Cache::forget("republished-packages");
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function QueryTable($request)
    {
        $query = $this->model->withDeleted()->where(function ($query) use ($request) {
            $query->where('id', 'like', '%'. $request->input('search.value') .'%');
            $query->orWhere('title', 'like', '%'. $request->input('search.value') .'%');
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

        if (isset($request['req']['status']) &&  $request['req']['status'] == '1') {
            $query->active();
        }

        if (isset($request['req']['is_free']) &&  $request['req']['is_free'] != '') {
            $query->where("is_free", $request['req']['is_free']);
        }

        if (isset($request['req']['status']) &&  $request['req']['status'] == '0') {
            $query->unactive();
        }

        return $query;
    }
}
