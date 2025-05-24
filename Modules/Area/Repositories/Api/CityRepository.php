<?php

namespace Modules\Area\Repositories\Api;

use DB;
use Hash;
use Modules\Area\Entities\City;
use Modules\Area\Entities\State;

class CityRepository
{

    function __construct(City $city)
    {
        $this->city   = $city;
    }

    public function getAllActive(&$request ,$order = 'id', $sort = 'desc')
    {
        $cities = $this->city->active()
        ->when($request->country_id, function($query) use(&$request){
            $query->where("country_id", $request->country_id);
        })->with([
            "states"=> fn($state)=> $state->active()
        ])
        ->orderBy($order, $sort)->get();
        return $cities;
    }

    public function findById($id)
    {
        $city = $this->city->active()->where('id',$id)->first();
        return $city;
    }
    public function getActiveStateInCity($request, $city_id){
        return State::active()->where("city_id", $city_id)->get();
    }
}
