<?php

namespace Modules\QSale\Entities;

use Illuminate\Database\Eloquent\Model;

class AppleTier extends Model
{
	const TIERS = [
		['tier_id' => "free",'price' => "0.00"],
		['tier_id' => 1,'price' => "0.99"],
		['tier_id' => 2,'price' => "2.99"],
		['tier_id' => 3,'price' => "10.99"],
	];
	protected $guarded   = ['id'];
	public function coins()
	{
	    return $this->hasMany(Coin::class);
	}
}
