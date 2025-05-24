<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\QSale\Transformers\Api\AdsResource;

use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Transformers\Api\AdTypeResource;
use Modules\QSale\Repositories\Api\AdTypeRepository as Repo;


class AdTypeController extends ApiController
{
    function __construct(Repo $repo)
    {
        
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $users =  $this->repo->getAll($request);
        return $this->response(
            AdTypeResource::collection($users)
        );
    }

    public function listAds(Request $request, $id)
    {
        $adType  =  $this->repo->findById($id);
        $ads       = $this->repo->listAds(
            $adType, 
            $request,
           ["user", "media", "addations", "attributes", "category","office","address",/*"country", "city", "state"*/]
        );
    
        return $this->responsePagnationWithData(
           AdsResource::collection($ads), 
           ["ad_type"=> new AdTypeResource($adType)]
        );
        
    }


    public function listAdsBasedType(Request $request)
    {
        $ads       = $this->repo->listAdsBasedType(
            $request,
           ["user", "media", "addations", "attributes", "category","office","address",/*"country", "city", "state"*/]
        );
    
        return $this->responsePagnationWithData(
           AdsResource::collection($ads), 
        );
        
    }

   



    
}
