<?php
namespace Modules\Core\Packages\Payment;

use Modules\Core\Packages\Payment\Contract\PaymentInterface;

class KnetPaymentService implements PaymentInterface
{
    // TEST CREDENTIALS
    protected $MERCHANT_ID    = "1201";
    protected $USERNAME 			 = "test";
    protected $PASSWORD     	 = "test";
    protected $API_KEY        = "jtest123";
    protected $URL            = "https://api.upayments.com/test-payment";
    protected $TEST_MOD       = 0;


    public function __construct()
    {
        $this->extraMerchantsData 					= [];
        if (config("app.env") == "production") {
            $this->API_KEY =  password_hash(config("services.payment.knet.api_key"), PASSWORD_BCRYPT);
            $this->TEST_MOD = 0;
            $this->MERCHANT_ID = config("services.payment.knet.merchant_id");
            $this->URL         = config("services.payment.knet.url");
            $this->USERNAME    = config("services.payment.knet.username");
            $this->PASSWORD    = config("services.payment.knet.password");

        }
        
    }

    public function setExtraMerchantsData($order){
        $this->extraMerchantsData['amounts'][0] 	 	= $order['total'];
        $this->extraMerchantsData['charges'][0]       = config("services.payment.knet.charge_amount");
        $this->extraMerchantsData['chargeType'][0] 	= config("services.payment.knet.charge_type");
        $this->extraMerchantsData['cc_charges'][0] 	= config("services.payment.knet.cc_charges");
        $this->extraMerchantsData['cc_chargeType'][0] = config("services.payment.knet.cc_chargeType");
        $this->extraMerchantsData['ibans'][0]			= config("services.payment.knet.iban_number");
    }

    public function send($order, $type ="api-order", $payment = "knet")
    {
        $url = $this->paymentUrls($type);
       
        $this->setExtraMerchantsData($order);
        $fields = [
                    // 'api_key' 			=> password_hash(self::EMAIL_MYFATOORAH,PASSWORD_BCRYPT),
                    'api_key' 				=> $this->API_KEY,
                    'merchant_id'			=>  $this->MERCHANT_ID,
                    'username' 				=> $this->USERNAME,
                    'password' 				=> stripslashes($this->PASSWORD),
                    'order_id' 				=> $order['id'],
                    'CurrencyCode'		=> setting('default_currency'), //only works in production mode
                    'CstFName' 				=> $order["name"] ??  'null',
                    'CstEmail'				=> $order["email"]?? 'null',
                    'CstMobile'				=> $order["mobile"] ? str_replace("-", "", $order["mobile"]) : 'null',
                    'success_url'   	=> $url['success'],
                    'error_url'				=> $url['failed'],
                    'test_mode'    		=> $this->TEST_MOD, // test mode enabled
                    // 'whitelabled'    	=> true, // only accept in live credentials (it will not work in test)
                    'payment_gateway'	=> $payment,// knet / cc
                    'total_price'			=> $order["total"] ,
                    'ExtraMerchantsData' 	=> json_encode($this->extraMerchantsData),
                ];
        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $server_output = json_decode($server_output, true);
        if ($server_output["status"] == "errors") {
            throw new \Exception($server_output["error_msg"], 502);
        }
       
        return $server_output['paymentURL'];
    }

    public function paymentUrls($type)
    {
        if ($type == 'api-order') {
            $url['success'] = url(route('api.payment.success'));
            $url['failed']  = url(route('api.payment.failed'));
        }

        if ($type == 'frontend-order') {
            $url['success'] = url(route('frontend.payment.success'));
            $url['failed']  = url(route('frontend.payment.failed'));
        }

        return $url;
    }


    public function getResultForPayment($data, $type ="api-order", $payment = "knet")
    {
        $order["id"]     = $data["id"];
        $order["total"]  = $data["total"];
        $order["name"]   = optional($data->user)->name ?? "" ;
        $order["email"]  = optional($data->user)->email?? "" ;
        $order["mobile"] = optional($data->user)->phone_code . "". optional($data->user)->mobile;
        return $this->send($order, $type, $payment);
    }
}
