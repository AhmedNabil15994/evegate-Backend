<?php

namespace Modules\QSale\Ws;

use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client;
use Modules\QSale\Ws\Response\WsResponse;

trait ConfigTrait
{
    private $accessToken;
    private $mode;
    private $url;

    function __construct()
    {
        $this->accessToken = env("WS_ACCESS_TOKEN","");
        $this->url = 'https://app.spaaro.io/api';
    }

    private function request($type, $action, $data)
    {
        $client = new Client();

        $params = [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer $this->accessToken"
            ],
        ];

        switch ($type) {
            case 'get':
            case 'post':
                $params[RequestOptions::JSON] = $data;
                break;
        }

        try {

            $res = $client->$type("{$this->url}/{$action}", $params);

            return new WsResponse($res);

        } catch (\GuzzleHttp\Exception\ClientException $e) {

            return new WsResponse($e,'error');
        }
    }

    protected function post($action, $data)
    {
        return $this->request('post', $action, $data);
    }

    protected function get($action, $data)
    {
        return $this->request('get', $action, $data);
    }
}
