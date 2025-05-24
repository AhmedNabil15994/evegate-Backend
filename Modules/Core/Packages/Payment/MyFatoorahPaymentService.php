<?php

namespace Modules\Core\Packages\Payment;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use Modules\Core\Packages\Payment\Contract\PaymentInterface;

class MyFatoorahPaymentService implements PaymentInterface
{
    public $API_KEY = "";

    public $URL = "https://apitest.myfatoorah.com/v2/";

    public function __construct()
    {
        $this->API_KEY = config("services.payment.my_fatoorah.secret_api_key_test");
        if (config("app.env") == "production") {
            $this->API_KEY = config("services.payment.my_fatoorah.secret_api_key_live");
            $this->URL  = "https://api.myfatoorah.com/v2/";
        }
    }

    public function send($order, $type = "api-order", $payment = "knet")
    {
        $fields = $this->getRequestFields($order, $type, $payment);
        // dd($fields);

        $client = new Client();

        try {
            $res = $client->post($this->URL ."SendPayment", [

                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $this->API_KEY
                ],

                RequestOptions::JSON => $fields
            ]);
            $body = json_decode($res->getBody(), true);

            if ($body["IsSuccess"] && isset($body["Data"]["InvoiceURL"])) {
                return $body["Data"]["InvoiceURL"];
            }

            throw new \Exception("error payment");
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 503);
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function getTransactionDetails($id)
    {
        $client = new Client();

        try {
            $res = $client->post($this->URL . "GetPaymentStatus", [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $this->API_KEY
                ],
                RequestOptions::JSON => [
                    "KeyType"=> "PaymentId",
                    "Key"    => $id
                ]
            ]);

            $body =  json_decode($res->getBody(), true);

            if ($body["IsSuccess"] && isset($body["Data"])) {
                return $body["Data"] ;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 503);
        }
    }

    /**
     * @param $order_id
     * @param $order
     * @return array
     */
    private function getRequestFields($order, $type, $payment)
    {
        $url = $this->paymentUrls($type);
        return [
            'InvoiceValue'   => $order['total'],
            'DisplayCurrencyIso' => setting('default_currency'),
            'NotificationOption' => "LNK",
            'Language' => locale(),
            "CustomerName"=> $order["name"],
            "CustomerEmail"=>$order["email"] ? $order["email"] :  "unknown@email.com",
            "CustomerMobile"=> $order["mobile"],
            "MobileCountryCode"=>"+".$order["phone_code"],
            
            'CallBackUrl' =>$url["success"],
            "ErrorUrl"    => $url["failed"] ,
            "UserDefinedField"=> $order["id"]
        ];
    }

    public function paymentUrls($type)
    {
        if ($type == 'api-order') {
            $url['success'] = url(route('api.payment.myfatoorah.success'));
            $url['failed']  = url(route('api.payment.myfatoorah.failed'));
        }

        if ($type == 'frontend-order') {
            $url['success'] = url(route('frontend.payment.myfatoorah.success'));
            $url['failed']  = url(route('frontend.payment.myfatoorah.failed'));
        }
        return $url;
    }


    public function getResultForPayment($data, $type ="api-order", $payment = "knet")
    {
        $order["id"]     = $data["id"];
        $order["total"]  = $data["total"];
        $order["name"]   = optional($data->user)->name ?? "unknown" ;
        $order["email"]  = optional($data->user)->email?? "" ;
        $order["mobile"] =  optional($data->user)->mobile;
        $order["phone_code"]= optional($data->user)->phone_code ;
        return $this->send($order, $type, $payment);
    }
}
