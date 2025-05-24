<?php

namespace Modules\QSale\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ScopesTrait;

class Coin extends Model
{
  	use HasTranslations, SoftDeletes , ScopesTrait;
	protected $guarded   = ['id'];
  	public $translatable 	= ['description' , 'title'];

	public function tier()
	{
		return $this->belongsTo(AppleTier::class,'apple_tier_id');
	}

	public function coins()
	{
		return $this->hasOne(User::class);
	}

	public function paymentTransactions()
	{
		return $this->hasMany(CoinPaymentTransaction::class);
	}
}
