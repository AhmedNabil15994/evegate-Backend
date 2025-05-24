<?php

namespace Modules\QSale\Repositories\Api;

use DB;
use Hash;
use Modules\QSale\Entities\Ads;
use Modules\QSale\Entities\AdsSeen  as Model;

class SeenRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

    public function addToCurrentUser($user, $id)
    {

        return $user->adsSeens()->syncWithoutDetaching($id);
    }


    public function isAddToUserId($user_id, $id)
    {
        return $this->model->where("ads_id", $id)
            ->where("user_id", $user_id)
            ->exists();
    }
}
