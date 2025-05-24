<?php

namespace Modules\Area\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Area\Transformers\Api\CityResource;
use Modules\Area\Transformers\Api\StateResource;
use Modules\Area\Transformers\Api\CountryResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Area\Repositories\Api\CountryRepository;
use Modules\Area\Repositories\Api\CityRepository as City;

class AreaController extends ApiController
{

    function __construct(City $city,CountryRepository $country)
    {
        $this->city = $city;
        $this->country = $country;
    }


    public function cities(Request $request)
    {
       
        $cities = $this->city->getAllActive($request);

        return $this->response(CityResource::collection($cities));
    }

    public function countries(Request $request)
    {
        $cities = $this->country->getAllActive($request);

        return $this->response(CountryResource::collection($cities));
    }

    public function states(Request $request, $id)
    {
        $states = $this->city->getActiveStateInCity($request, $id);

        return $this->response(StateResource::collection($states));
    }
}
