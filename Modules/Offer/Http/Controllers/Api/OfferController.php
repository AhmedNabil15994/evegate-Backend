<?php

namespace Modules\Offer\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Offer\Transformers\Api\OfferResource;

use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Offer\Repositories\Api\OfferRepository as Repo;


class OfferController extends ApiController
{
    public $repo;
    function __construct(Repo $repo)
    {

        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $offers =  $this->repo->getAll($request, $with = ["category"]);
        return $this->responsePagnation(
            OfferResource::collection($offers)
        );
    }

    public function view(Request $request, $id)
    {
      
        $offer  =  $this->repo->findById($id);

        return $this->response(
            new OfferResource($offer)
        );
    }
}
