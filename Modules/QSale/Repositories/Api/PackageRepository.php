<?php

namespace Modules\QSale\Repositories\Api;

use DB;
use Hash;
use Modules\QSale\Entities\Package  as Model;

class PackageRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

  


    public function getAll(&$request, $order = 'sort', $sort = 'asc')
    {
        $models = $this->model->active()
                     ->currentSubscription($request)
                     ->orderBy($order, $sort)
                     ;

        if ($request->type) {
            $models->where("type", $request->type);
        }
        
        if (auth("api")->check()) {
            $user = auth("api")->user();
            if ($user->currentSubscription) {
                $models->where("first_time", false);
            }
        }
        
        return $models->paginate($request->page_count ??  config("app.page_count", 15));
    }

    public function findById($id, $with=[])
    {
        $model = $this->model->with($with)->findOrFail($id);
        return $model;
    }
}
