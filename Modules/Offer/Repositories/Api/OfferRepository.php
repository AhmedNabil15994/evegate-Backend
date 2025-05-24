<?php

namespace Modules\Offer\Repositories\Api;

use DB;
use Hash;
use Modules\Offer\Entities\Offer  as Model;

class OfferRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

  


    public function getAll(&$request,$with=[] ,$order = 'id', $sort = 'desc')
    {
        $models = $this->model
                        ->with($with)
                        ->categoryFilter($request)
                        ->active()
                        ->started()
                        ->unexpired()
                        ->orderBy($order, $sort)
                       ;
                
        return $models->paginate($request->page_count ?? config("app.page_count", 15));
    }

    public function findById($id, $with=[])
    {
        $model = $this->model->with($with)->findOrFail($id);
        return $model;
    }
}
