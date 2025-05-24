<?php
namespace Modules\QSale\Concerns;

use Modules\User\Entities\User;

trait CutCoinsTrait
{
    public function decrimentCoinsNew(int $total, User $user, $model_id, $model_type="ad_order")
    {
        $userCoinsBlance = $user->coins;
        
        $user->coinsTransactions()->create([
            "balance_before" => $userCoinsBlance->balance_after,
            "coins_number" => - $total,
            "balance_after" =>  $userCoinsBlance->balance_after - $total,
            "data" =>[
                "type" => $model_type,
                "ads_id" => $model_id
            ],
        ]);
    }
}