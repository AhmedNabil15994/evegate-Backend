<?php

namespace Modules\QSale\Entities;

use Modules\Area\Entities\City;
use Modules\Area\Entities\State;
use Modules\Core\Traits\UsesUuid;
use Modules\Area\Entities\Country;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ClearsResponseCache;

class AdsAddress extends Model
{
    use UsesUuid;
    use  ClearsResponseCache;
    protected $guarded = ["id"];

    protected $with                         = ["country", "city", "state"];


    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function Ads()
    {
        return $this->belongsTo(Ads::class);
    }

    public function getAddress()
    {
        $address = "";
        if ($this->country) {
            $address .= $this->country->translateOrDefault(locale())->title .",";
        }
        if ($this->city) {
            $address .= $this->city->translateOrDefault(locale())->title .",";
        }
        if ($this->state) {
            $address .= $this->state->translateOrDefault(locale())->title ;
        }
        return $address;
    }
}
