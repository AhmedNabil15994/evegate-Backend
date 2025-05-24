<?php

namespace Modules\Advertisement\Repositories\Api;

use Modules\Advertisement\Entities\Advertisement as Model;

 class AdvertisementRepository
{
    function __construct(Model $model)
    {
        $this->model   = $model;
    }

    public function getRandomPerRequest()
    {
        $models = $this->model->active()->unexpired()->started()->inRandomOrder()->take(6)->get();
        return $models;
    }
}
