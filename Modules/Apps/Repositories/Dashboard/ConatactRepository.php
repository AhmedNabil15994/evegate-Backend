<?php

namespace Modules\Apps\Repositories\Dashboard;

use DB;
use Hash;

use Modules\Apps\Entities\Contact as Model;

class ConatactRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

   

    public function findById($id)
    {
        $model = $this->model->find($id);
        return $model;
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
            $query->where('id', 'like', '%'. $request->input('search.value') .'%');

            $query->orWhere("username",'like', '%'. $request->input('search.value') .'%')
                 ->orWhere("mobile",'like', '%'. $request->input('search.value') .'%')
                 ->orWhere("email",'like', '%'. $request->input('search.value') .'%')
                 ->orWhere("message",'like', '%'. $request->input('search.value') .'%');


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

        if (isset($request['req']['type']) && $request['req']['type'] != '') {
            $query->where('type', '=', $request['req']['type']);
        }
         
        

        

        
        return $query;
    }

  
}
