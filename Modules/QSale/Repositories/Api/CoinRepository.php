<?php

namespace Modules\QSale\Repositories\Api;

use Modules\QSale\Entities\{CoinPaymentTransaction,Coin};
use Illuminate\Support\Facades\DB;

class CoinRepository
{
    protected $model;
    protected $coin;

    public function __construct(CoinPaymentTransaction $model, Coin $coin)
    {
        $this->model   = $model;
        $this->coin   = $coin;
    }

    public function findCoinById($id)
    {
        return $this->coin->active()->whereHas('tier',function($q) use($id){
            $q->where("tier_id", $id);
            $q->orWhere("google_tier_id", $id);
        })->first();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function findByTierId($id)
    {
        return $this->model->whereHas('coin',function($q) use($id){
            $q->whereHas('tier',function($q) use($id){
                $q->where("tier_id", $id);
                $q->orWhere("google_tier_id", $id);

                if(auth('api')->check() && auth('api')->user()->take_free_tier){
                    $q->where('tier_id','!=','free');
                }
            });
        })->first();
    }

    public function getCoins($request)
    {
        return $this->coin->active()->where(function($query) use($request){
            if($request->user('api') && $request->user('api')->take_free_tier){
                $query->whereHas('tier',function($query){
                    $query->where('tier_id','!=','free');
                });
            }
        })->orderBy('sort','desc')->get();
    }
    
    public function createPayment($request)
    {
        $coin = $this->findCoinById($request->tier_id);

        if(!$coin)
            return false;

        $payment = $request->user('api')->coinsPaymentTransactions()->updateOrCreate([

            'coin_id' => $coin->id,
            'status' => "pending",
        ],[
            'coin_id' => $coin->id,
            'transaction_provider' => $request->transaction_provider,
        ]);

        $payment->refresh();


        if($request->tier_id == "free"){

            $this->saveTransactionStatusAndUpdateCoins($payment,$coin,"success");
            $request->user('api')->update(['take_free_tier' => true]);
        }

        return $payment;
    }
    
    public function updatePayment($request)
    {
        $transaction = $this->findByTierId($request->tier_id);

        if(!$transaction)
            return false;

        $coin = $transaction->coin;

        if(!$coin)
            return false;

        DB::beginTransaction();

        try {

            $this->saveTransactionStatusAndUpdateCoins($transaction,$coin,$request->status,$request->transaction_id);
        
            DB::commit();

            $transaction->refresh();

            return $transaction;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    
    public function saveTransactionStatusAndUpdateCoins($transaction,$coin,$status,$transaction_id = null)
    {

        if($status == "success"){

            $userCoinsBlance = request()->user()->coins;

            if(!$userCoinsBlance){
                $transaction->userCoin()->create([
                    "balance_before" => 0,
                    "coins_number" => $coin->coins_number,
                    "balance_after" => $coin->coins_number,
                    "user_id" => request()->user()->id,
                ]);
            }else{

                $transaction->userCoin()->create([
                    "balance_before" => $userCoinsBlance->balance_after,
                    "coins_number" => $coin->coins_number,
                    "balance_after" => $coin->coins_number + $userCoinsBlance->balance_after,
                    "user_id" => request()->user()->id,
                ]);
            }
        }

        $transaction->update([
            'status' => $status,
            'transaction_id' => request()->transaction_id,
        ]);

        $transaction->refresh();
    }
}
