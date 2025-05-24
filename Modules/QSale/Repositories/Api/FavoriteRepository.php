<?php

namespace Modules\QSale\Repositories\Api;

use DB;
use Hash;
use Modules\QSale\Entities\Ads;
use Modules\QSale\Entities\Favorite  as Model;

class FavoriteRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }



    public function getAds($id)
    {
        return Ads::find($id);
    }

    public function listCurrentUser($user, $with = [], $order = 'id', $sort = 'Desc')
    {
        $models = $user
            ->adsFavorites()
            ->allowShowWithOutActive()
            ->with($with)->orderBy($order, $sort)
            ->paginate(request()->page_count ?? config("app.page_count", 15));
        return $models;
    }

    public function deleteFromCurrentUser($user, $id)
    {
        $user->adsFavorites()->detach($id);
    }

    public function addToCurrentUser($user, $id)
    {
        $user->adsFavorites()->syncWithoutDetaching($id);
    }

    public function toggleToCurrentUser($user, $id)
    {
        return $user->adsFavorites()->toggle($id);
    }

    public function isAddToUserId($user_id, $id)
    {
        return $this->model->where("ads_id", $id)
            ->where("user_id", $user_id)
            ->exists();
    }
}
