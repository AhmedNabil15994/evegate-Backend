<?php

namespace Modules\QSale\Repositories\Dashboard;

use Hash;
use Carbon\Carbon;
use Modules\QSale\Enum\AdsType;
use Modules\User\Entities\User;
use Modules\QSale\Enum\AdsStatus;
use Illuminate\Support\Facades\DB;
use Modules\QSale\Entities\Addation;
use Illuminate\Support\Facades\Cache;
use Modules\QSale\Entities\Payment  as Model;

class PaymentRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }


    public function getAll($order = 'id', $sort = 'desc')
    {
        $models = $this->model->orderBy($order, $sort)->get();
        return $models;
    }

    public function findById($id, $with = [])
    {
        $model = $this->model->with($with)->findOrFail($id);
        return $model;
    }
    public function QueryTable($request)
    {
        $query = $this->model->where('status', 'paied')->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
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
        if (isset($request['req']['status']) &&  $request['req']['status'] != '') {
            $query->where("status", $request['req']['status']);
        }
        return $query;
    }
}
