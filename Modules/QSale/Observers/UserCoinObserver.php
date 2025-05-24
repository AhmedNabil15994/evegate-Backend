<?php
  
namespace Modules\QSale\Observers;
  
use Modules\QSale\Entities\UserCoin;
  
class UserCoinObserver
{
  
    /**
     * Handle the UserCoin "created" event.
     *
     * @param  \Modules\QSale\Entities\UserCoin  $request
     * @return void
     */
    public function created(UserCoin $model)
    {
        $model->user->coin_blance = $model->balance_after;
        $model->user->save();
    }
}