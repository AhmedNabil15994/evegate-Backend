<?php

namespace Modules\Question\Repositories\Dashboard;


use DB;
use Hash;
use Modules\Question\Entities\Question as Model;

class QuestionRepository
{

    function __construct(Model $model)
    {
        $this->model   = $model;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $models = $this->model->active()->orderBy($order, $sort)->get();
        return $models;
    }


    public function getAll($order = 'id', $sort = 'desc')
    {
        $models = $this->model->orderBy($order, $sort)->get();
        return $models;
    }

    public function findById($id)
    {
        $model = $this->model->withDeleted()->find($id);
        return $model;
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {

          $model = $this->model->create([
            'is_active'         => $request->is_active == "on" ? 1 : 0
          ]);

          $this->translateTable($model,$request);

          DB::commit();
          return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function update($request,$id)
    {
        DB::beginTransaction();

        $model = $this->findById($id);
        $restore = $request->restore ? $this->restoreSoftDelte($model) : null;

        try {

            $model->update([
              'is_active'         => $request->is_active == "on" ? 1 : 0,
              ]);

            $this->translateTable($model,$request);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function restoreSoftDelte($model)
    {
        $model->restore();
    }

    public function translateTable($model,$request)
    {
        foreach ($request['question'] as $locale => $value) {
          $model->translateOrNew($locale)->question           = $value;
          $model->translateOrNew($locale)->answer     = $request['answer'][$locale];
        }

        $model->save();
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $model = $this->findById($id);

            if ($model->trashed()):
              $model->forceDelete();
            else:
              $model->delete();
            endif;

            DB::commit();
            return true;

        }catch(\Exception $e){
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

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function QueryTable($request)
    {
        $query = $this->model->withDeleted()->where(function($query) use($request){

                      $query->where('id'                    , 'like' , '%'. $request->input('search.value') .'%');

                      $query->orWhere( function( $query ) use($request){

                          $query->whereHas('translations', function($query) use($request) {

                              $query->where('question'    , 'like' , '%'. $request->input('search.value') .'%');
                              $query->orWhere('answer'        , 'like' , '%'. $request->input('search.value') .'%');
                             

                          });

                      });

                });

        $query = $this->filterDataTable($query,$request);

        return $query;
    }

    public function filterDataTable($query,$request)
    {
        // Search Sections by Created Dates
        if (isset($request['req']['from']) && $request['req']['from'] != '')
            $query->whereDate('created_at'  , '>=' , $request['req']['from']);

        if (isset($request['req']['to']) && $request['req']['to'] != '')
            $query->whereDate('created_at'  , '<=' , $request['req']['to']);

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'only')
            $query->onlyDeleted();

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'with')
            $query->withDeleted();

        if (isset($request['req']['is_active']) &&  $request['req']['is_active'] != "")
            $query->where("is_active", $request['req']['is_active'] );

        
        return $query;
    }

}
