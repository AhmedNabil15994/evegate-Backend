<?php

namespace Modules\ShippingCompany\Repositories\Api;

use DB;
use Hash;
use Modules\ShippingCompany\Entities\ShippingCompany  as Model;

class ShippingCompanyRepository
{
  public function __construct(Model $model)
  {
    $this->model   = $model;
  }


  public function getAll(&$request, $with = [], $order = 'id', $sort = 'desc')
  {
    $models = $this->model
      ->where(function($query) use($request){

        if($request->country_id){
          $query->where('country_id', $request->country_id);
        }

      })
      ->with($with)
      ->orderBy($order, $sort);

    return $models->paginate($request->page_count ?? config("app.page_count", 15));
  }

  public function findById($id, $with = [])
  {
    $model = $this->model->with($with)->findOrFail($id);
    return $model;
  }
}
