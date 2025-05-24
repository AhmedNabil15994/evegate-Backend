<?php

namespace Modules\QSale\Repositories\Api;

use File;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Modules\Qsale\Events\PaiedEvent;
use Modules\Category\Entities\Category;
use Modules\User\Entities\User as Model;
use Modules\Core\Packages\Payment\Contract\PaymentInterface;

class TechnicalRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

    public function getAllActive(&$request, $with=[], $order = 'id', $sort = 'desc')
    {
        $query =   $this->model
                    ->technicalType()
                    ->allowShow()
                    ->searchFilter($request);

        $this->baseFilterQuery($query, $request);

        return $query->with($with)
                    ->orderBy($order, $sort)
                    ->withCount(["ads"  => fn ($query) =>$query->allowShow()])
                    ->paginate($request->page_count ?? config("app.page_count", 15));
    }

    public function findById($id, $with=[])
    {
        return $this->model
                    ->technicalType()
                    ->allowShow()
                    ->where("id", $id)
                    ->with($with)->firstOrFail();
    }

    public function getAdsFor(&$model)
    {
        $with = \Modules\QSale\Entities\Ads::getMainWith();
        return $model->ads()
                    ->allowShow()
                    ->with($with)
                    ->latest()
                    ->paginate($request->page_count ?? config("app.page_count", 15));
    }


    public function baseFilterQuery(&$query, $request)
    {

        if ($request->search) {
            $query->where(function ($query) use (&$request) {
                $query->where("name", "like", "%".$request->search."%")
                ->orWhereHas("company", function ($company) use (&$request) {
                    $company->where("title", "like", "%".$request->search."%");
                });
            });
        }
    }
}
