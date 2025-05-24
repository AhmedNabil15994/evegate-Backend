<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\QSale\Entities\Ads;

use Modules\QSale\Transformers\Api\AdsResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Repositories\Api\SeenRepository as Repo;

class AdsSeenController extends ApiController
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function attach(Request $request, $id)
    {
        $user  = auth('api')->user();
        $ads   = Ads::find($id);
        if (!$ads) return $this->notFoundResponse();
        $attach =  $this->repo->addToCurrentUser($user, $id);
        return $this->response($attach);
    }
}
