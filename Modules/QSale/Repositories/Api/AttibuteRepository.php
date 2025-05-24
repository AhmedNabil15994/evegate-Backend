<?php

namespace Modules\QSale\Repositories\Api;

use DB;
use Hash;
use Modules\QSale\Entities\Addation  as Model;

class AttibuteRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

  


    public function getAll(&$request , $order = 'id', $sort = 'asc')
    {
        $models = $this->model->active()->orderBy($order, $sort)
                     ->get();
        return $models;
    }

    public function findById($id, $with=[])
    {
        $model = $this->model->with($with)->findOrFail($id);
        return $model;
    }

    public function listAds(&$model, &$request, $with=[])
    {
        return $model->ads()
                    ->allowShow()
                    ->searchBase($request)
                    ->categoryFilter($request)
                    ->attributeFilter($request)
                    ->priceFilter($request)
                    ->filterAdType($request)
                    ->latest()
                    ->paginate($request->page_count ?? config("app.page_count", 15));
    }


    


   
}
