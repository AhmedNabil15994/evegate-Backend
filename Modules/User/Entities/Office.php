<?php

namespace Modules\User\Entities;

use Modules\Area\Entities\City;
use Modules\QSale\Entities\Ads;
use Modules\Area\Entities\State;
use Modules\Area\Entities\Country;
use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\CasscadeAttach;
use Modules\Core\Traits\ClearsResponseCache;

class Office extends Model
{
    use ScopesTrait;
    use CasscadeAttach;
    use  ClearsResponseCache;
    protected $guarded 				    	= ['id'];
    protected $with                         = ["country", "city", "state"];

    protected $casscadeAttachs = ["image"];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    protected $casts = [
      'socials' => 'array',
    ];

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

    public function scopeAllow($query)
    {
        $query->where(function ($query) {
            $query->active()
               ->whereHas("user", function ($user) {
                   $user->active();
               });
        });
    }

    public function scopeSearch($query, $request)
    {
        $query->when($request->search, function ($query) use (&$request) {
            $query->where("title", 'like', '%'. $request->input('search') .'%');
        })
      ->when($request->country_id, function ($query) use (&$request) {
          $query->where("country_id", $request->country_id);
      })
      ->when($request->city_id, function ($query) use (&$request) {
          $query->where("city_id", $request->city_id);
      })
      ->when($request->state_id, function ($query) use (&$request) {
          $query->where("state_id", $request->state_id);
      });
    }

    public function ads()
    {
        return $this->hasMany(Ads::class, "office_id");
    }
}
