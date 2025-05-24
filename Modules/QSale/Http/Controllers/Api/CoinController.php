<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\QSale\Http\Requests\Api\Coin\PaymentTransactionRequest;
use Modules\QSale\Repositories\Api\CoinRepository;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Transformers\Api\CoinPaymentTransactionResource;
use Modules\QSale\Transformers\Api\CoinResource;

class CoinController extends ApiController
{
    private $repo;

    public function __construct(CoinRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list(Request $request)
    {
        return CoinResource::collection($this->repo->getCoins($request));
    }

    public function createPaymentTransaction(PaymentTransactionRequest $request)
    {
        if($request->tier_id == "free" && $request->user('api')->take_free_tier == 1){


            return  $this->error(__("You has already used your free tier"));
        }

        $payment = $this->repo->createPayment($request);
      
        if($payment)
            return $this->response(new CoinPaymentTransactionResource($payment));

        return  $this->error(__("failed to create payment transaction"));
    }

    public function updatePaymentTransaction(PaymentTransactionRequest $request)
    {

        $payment = $this->repo->updatePayment($request);
      
        if($payment)
            return $this->response(new CoinPaymentTransactionResource($payment));

        return  $this->error(__("failed to update payment transaction"));
    }
}
