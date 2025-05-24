<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\QSale\Enum\AddationType;
use Modules\QSale\Transformers\Api\AdsResource;
use Modules\QSale\Transformers\Api\AdTypeResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Repositories\Api\AdTypeRepository;
use Modules\QSale\Repositories\Api\AddationRepository;
use Modules\Category\Transformers\Api\CategoryResource;
use Modules\QSale\Transformers\Api\AddationResourceHome;
use Modules\Category\Repositories\Api\CategoryRepository;

class HomeController extends ApiController
{
    public function __construct(CategoryRepository $categoryRepo, AddationRepository $addaionRepo,AdTypeRepository $adTypeRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->addaionRepo = $addaionRepo;
        $this->adTypeRepo = $adTypeRepo;
    }

    public function index(Request $request)
    {
        // $mainCategory = $this->categoryRepo->getMainCategory();
        $categories = $this->categoryRepo->tree();
        $addations    = $this->addaionRepo->getForHome();
        $addationsStory    = $this->addaionRepo->getForHome(AddationType::STORY);
        $adType= $this->adTypeRepo->getAll($request);
      
        return  $this->response(
            [
                "addations"  => AddationResourceHome::collection($addations),
                // "categories" => CategoryResource::collection($mainCategory),
                "categories"   => CategoryResource::collection($categories) ,
                "addationStory"=>  AddationResourceHome::collection($addationsStory),
                "ad_types"      => AdTypeResource::collection($adType)
            ]
        );
    }
}
