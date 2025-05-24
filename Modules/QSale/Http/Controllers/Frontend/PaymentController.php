<?php

namespace Modules\QSale\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\QSale\Repositories\Frontend\PaymentRepository as Repo;

class PaymentController extends Controller
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

   

    public function success(Request $request)
    {
        $type = $this->repo->successPayment($request);
        if ($type === "ads") {
            return redirect()->route("frontend.user.my_ads")
                       ->withSuccess(__("qsale::frontend.messages.success_paid_ads")) ;
        }

        if ($type === "republished") {
            return redirect()->route("frontend.user.my_ads")
                        ->withSuccess(__("qsale::frontend.republished_package.paid_success")) ;
        }
        return  "success ".$type;
    }

    public function failed(Request $request)
    {
        $type =  $this->repo->failedPayment($request);
        if ($type === "ads") {
            return redirect()->route("frontend.user.my_ads")
                       ->withError(__("qsale::frontend.messages.failed_payment")) ;
        }

        if ($type === "republished") {
            return redirect()->route("frontend.user.my_ads")
                        ->withError(__("qsale::frontend.messages.failed_payment")) ;
        }
        return  "failed " . $type;
    }

    public function successMFatoorah(Request $request)
    {
        $data = $this->repo->getTransaction($request->paymentId);
        $type = $this->repo->successPayment($data, "myfatoorah");

        if ($type === "ads") {
            return redirect()->route("frontend.user.my_ads")
                       ->withSuccess(__("qsale::frontend.messages.success_paid_ads")) ;
        }

        if ($type === "republished") {
            return redirect()->route("frontend.user.my_ads")
                        ->withSuccess(__("qsale::frontend.republished_package.paid_success")) ;
        }
        return  "success ".$type;
    }

    public function failedMFatoorah(Request $request)
    {
        $type =  $this->repo->failedPayment($request);
        if ($type === "ads") {
            return redirect()->route("frontend.user.my_ads")
                       ->withError(__("qsale::frontend.messages.failed_payment")) ;
        }

        if ($type === "republished") {
            return redirect()->route("frontend.user.my_ads")
                        ->withError(__("qsale::frontend.messages.failed_payment")) ;
        }
        return  "failed " . $type;
    }
}
