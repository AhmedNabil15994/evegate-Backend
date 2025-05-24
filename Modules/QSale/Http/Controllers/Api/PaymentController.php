<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;

use Modules\QSale\Repositories\Api\PaymentRepository as Repo;

class PaymentController extends ApiController
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }



    public function success(Request $request)
    {
        $count =  count($request->all());
        if ($count > 0) {
            $this->repo->successPayment($request);
        }
        return  "success";
    }

    public function failed(Request $request)
    {
        $this->repo->failedPayment($request);
        return  "failed";
    }

    public function successMFatoorah(Request $request)
    {
        // dd($request->toArray());
        $data = $this->repo->getTransaction($request->paymentId);

        $this->repo->successPayment($data, "myfatoorah");
        return  "success";
    }

    public function failedMFatoorah(Request $request)
    {
        $this->repo->failedPayment($request);
        return  "failed";
    }
}
