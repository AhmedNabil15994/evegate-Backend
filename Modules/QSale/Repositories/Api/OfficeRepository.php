<?php

namespace Modules\QSale\Repositories\Api;

use File;
use Modules\User\Entities\User;
use Modules\User\Entities\Office as Model;
use Illuminate\Support\Facades\DB;
use Modules\Qsale\Events\PaiedEvent;
use Modules\Core\Packages\Payment\Contract\PaymentInterface;

class OfficeRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

    public function getAllActive(&$request, $order = 'id', $sort = 'desc')
    {
        return  $this->model->allow()
            ->search($request)
            ->with("user")
            ->orderBy($order, $sort)
            ->withCount(["ads" => fn ($query) => $query->allowShow()])
            ->paginate($request->page_count ?? config("app.page_count", 15));
    }

    public function findById($id, $with = [])
    {
        return $this->model->allow()
            ->where("id", $id)->with($with)->firstOrFail();
    }

    public function getAdsForOffice(&$office)
    {
        $with = \Modules\QSale\Entities\Ads::getMainWith();

        return $office->ads()
            ->allowShow()
            ->with($with)
            ->latest()
            ->paginate($request->page_count ?? config("app.page_count", 15));
    }
}
