<?php

namespace Modules\QSale\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class CoinPaymentTransaction extends Model
{
	protected $guarded   = ['id'];

	public function userCoin()
	{
		return $this->hasOne(UserCoin::class,'payment_id');
	}

	public function coin()
	{
		return $this->belongsTo(Coin::class,'coin_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class,'user_id');
	}
}
