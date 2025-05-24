<?php

namespace Modules\Core\Packages\Payment;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use Modules\Core\Packages\Payment\Contract\PaymentInterface;

class TapPaymentService implements PaymentInterface
{
    public const API_KEY    = "sk_test_eoIW8Dm6XyTuUdk0qsf71cj9";
    // const API_KEY    = "sk_live_sjKcG27dHLW6XuJEZeUk3OtP";

    /**
     * @param $order
     * @return array|mixed
     */
    public function send($order, $type = "api-order", $payment = "knet")
    {
        $fields = $this->getRequestFields($order, $type, $payment);

        $client = new Client();

        try {
        $res = $client->post('https://api.tap.company/v2/charges/', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . self::API_KEY
            ],
            RequestOptions::JSON    => $fields
        ]);

        return json_decode($res->getBody(), true);
        } catch (\Exception $e) {
            return [
                'server_response' => 'error',
                'order_id'        => $order->id
            ];
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function getResultForPayment($order, $type = "api-order", $payment = "knet")
    {
        $client = new Client();

        try {
            $res = $client->get('https://api.tap.company/v2/charges/' . '967876cc-d9cc-4da1-bbcb-ac912fcccf67', [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . self::API_KEY
                ]
            ]);

            return json_decode($res->getBody(), true);
        } catch (\Exception $e) {
            return [
                'server_response' => 'error',
            ];
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
            'amount'               => $order['total'],
            'currency'             => 'KWD',
            'threeDSecure'         => true,
            'save_card'            => false,
            'description'          => 'Order Fees',
            'statement_descriptor' => 'Sample',
            'receipt'              => [
                'email' => true,
                'sms'   => false
            ],
            'metadata' => [
                'udf4' => $payment,
                'udf5' => $order->id,
            ],
            'customer' => [
                'first_name' => 'asdfsdaf',
                'email'      => 'asdfsdaf',
                'phone'      => [
                    'country_code' => '00',
                    'number'       => $order->mobile
                ]
            ],
            'source'               => ['id' => 'src_all'],
            'redirect'             => [
                'url' => route('api.payment.success'),
            ],
            'post'             => [
                'url' => route('api.payment.success'),
            ]
        ];
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
}
