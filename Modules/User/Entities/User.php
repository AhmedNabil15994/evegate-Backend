<?php

namespace Modules\User\Entities;

use Modules\QSale\Entities\Ads;
use Modules\QSale\Entities\CoinPaymentTransaction;
use Modules\QSale\Entities\UserCoin;
use Modules\User\Enums\UserType;
use Modules\QSale\Enum\AdsStatus;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Modules\Area\Entities\Country;
use Modules\User\Entities\Company;
use Modules\Core\Traits\ScopesTrait;
use Modules\Core\Traits\CasscadeAttach;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Modules\QSale\Entities\Subscription;
use Modules\Core\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\DeviceToken\Entities\DeviceToken;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Modules\Core\Filters\Search\SearchManager;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Modules\QSale\Entities\AdsSeen;

class User extends Authenticatable implements HasLocalePreference
{
    use Notifiable, ScopesTrait, HasApiTokens;
    use LaratrustUserTrait,  SearchManager;
    use  ClearsResponseCache;

    use CasscadeAttach;

    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $with = [];


    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_active' => 1,
        "admin_verified" => 1,
        "number_of_free" => 0,
    ];

    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'image', 'phone_code', "type",
        "is_active", "code_verified", "setting", "country_id", "type", "is_verified", "firebase_uuid",
        "admin_verified",
        "take_free_tier",
        "country_id",
        "code",
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        "setting" => "array",
        "is_verified" => "boolean"
    ];



    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class, "user_id");
    }

    public function country()
    {
        return $this->belongsTo(Country::class, "country_id");
    }

    public function ads()
    {
        return $this->hasMany(\Modules\QSale\Entities\Ads::class, "user_id");
    }

    public function adsAllow()
    {
        return $this->hasMany(\Modules\QSale\Entities\Ads::class, "user_id")
            ->allowShow();
    }



    public function adsFavorites()
    {
        return $this->belongsToMany(Ads::class, "favorites", "user_id", "ads_id")
            ->withTimestamps();
    }
    public function adsSeens()
    {
        return $this->belongsToMany(ads::class, "ads_seen", "user_id", "ads_id");
    }

    public function rates()
    {
        return $this->hasMany(UserRate::class, "user_id");
    }

    public function coins()
    {
        return $this->hasOne(UserCoin::class, "user_id")->latest();
    }

    public function coinsTransactions()
    {
        return $this->hasMany(UserCoin::class, "user_id");
    }

    public function coinsPaymentTransactions()
    {
        return $this->hasMany(CoinPaymentTransaction::class, "user_id");
    }

    // public function getCoinBlanceAttribute()
    // {
    //     return optional($this->coins)->balance_after ?? 0;
    // }


    public function scopeWithAvgRate($query)
    {
        $query->withCount([
            "rates as rates_avg" => function ($query) {
                $query->select(DB::raw('ROUND( IFNULL(AVG(user_rates.rate),0) , 1)'));
            },
            "rates"
        ]);
    }

    public function givingRates()
    {
        return $this->hasMany(UserRate::class, "from_id");
    }

    public function office()
    {
        return $this->hasOne(Office::class, 'user_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'user_id');
    }


    public function currentSubscription()
    {
        return $this->hasOne(Subscription::class, 'user_id')->where("is_default", true);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }
    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'user_id')->where("is_default", true);
    }


    public function scopeUser($query)
    {
        return $query->whereIn('type', ["user"]);
    }

    public function scopeAdsCount($query)
    {
        return $query->withCount("adsAllow");
    }

    public function scopeCompanyType($query)
    {
        return $query->where("type", UserType::COMPANY);
    }

    public function scopeOfficeUser($query)
    {
        return $query->where('type', "office");
    }

    public function scopeAdminUser($query)
    {
        return $query->where('type', "admin");
    }



    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function preferredLocale()
    {
        return isset($this->setting["lang"]) ? $this->setting["lang"] : locale();
    }

    public function getPhone()
    {

        $phoneCode = $this->phone_code;
        $mobile = $this->mobile;

        if($phoneCode == '20'){
            $phone = $phoneCode . ((int)$mobile);
        }else{
            $phone = $phoneCode . $mobile;
        }

        return $phone;
    }



    public function scopeSearchFilter($query, &$request)
    {
    }


    public function scopeAllowShow($query)
    {
        $query->where("is_active", 1)->where("admin_verified", 1);
    }
    public function scopeFilter($query)
    {
        $query->where("name", 'like', "%" . request('search') . "%");
    }


    /*
    * CreateUserCoinsBlance New Object & Insert to DB
    */
    public function CreateUserCoinsBlance($coins)
    {
        $userCoinsBlance = $this->coins;

        if(!$userCoinsBlance){

            $this->coinsTransactions()->create([
                "balance_before" => 0,
                "coins_number" => $coins,
                "balance_after" => $coins,
                "admin_id" => auth()->user()->id,
            ]);
        }else{
            
            if($coins != $userCoinsBlance->balance_after){

                $this->coinsTransactions()->create([
                    "balance_before" => $userCoinsBlance->balance_after,
                    "coins_number" => $coins - $userCoinsBlance->balance_after,
                    "balance_after" => $coins,
                    "admin_id" => auth()->user()->id,
                ]);
            }
        }
    }
}
