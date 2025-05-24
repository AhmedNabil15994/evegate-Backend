<?php

namespace Modules\QSale\Repositories\Frontend;

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

  

    

    public function toggleToCurrentUser($user, $id)
    {
        return $user->adsFavorites()->toggle($id);
    }
}
