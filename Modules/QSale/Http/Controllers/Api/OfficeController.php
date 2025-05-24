<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;

use Modules\QSale\Transformers\Api\AdsResource;

use Modules\User\Transformers\Api\OfficeResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Repositories\Api\OfficeRepository as Repo;

class OfficeController extends ApiController
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request){
       $offices = $this->repo->getAllActive($request);

       return $this->responsePagnation(
             OfficeResource::collection($offices)
       );
    }

    public function show(Request $request, $id){
        $office = $this->repo->findById($id, ["user"]);
        return $this->response(
              new OfficeResource($office)
        );
    }

    public function getAds(Request $request, $id){
        $office = $this->repo->findById($id, ["user"]);
        $ads    = $this->repo->getAdsForOffice($office);
        return $this->responsePagnationWithData(
             AdsResource::collection($ads),
             ["office"=>new OfficeResource($office) ]
        );
    }

     

    public function currentOffice(Request $request){
        $office = auth()->user()->office;
        return $this->response(
              $office ? new OfficeResource($office) : null
        );
     }


   
}
