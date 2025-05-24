<?php

namespace Modules\QSale\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ScopesTrait;
use Modules\User\Entities\User;

class UserCoin extends Model
{
  	use ScopesTrait;
	protected $guarded   = ['id'];

	protected $casts = [
		'data' => 'array',
	];


	protected function asJson($value)
	{
	    return json_encode($value, JSON_UNESCAPED_UNICODE);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function admin()
	{
		return $this->belongsTo(User::class,'admin_id');
	}

	public function paymentTransaction()
	{
		return $this->belongsTo(CoinPaymentTransaction::class,'payment_id');
	}
}
