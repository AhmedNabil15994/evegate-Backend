<?php

namespace Modules\Core\Packages\SMS;

use Illuminate\Support\Facades\Hash;

class SmsBox implements SmsGetWay
{
    public function __construct()
    {
        $this->username              = config("services.sms.sms_box_new.username");
        $this->password              = config("services.sms.sms_box_new.password");
        $this->customerId            = config("services.sms.sms_box_new.customerId");
        $this->senderText            = config("services.sms.sms_box_new.senderText");
    }



    public function send($message, $phone)
    {

        try {
            $data = [
                "username"      => $this->username,
                "password"      => "password-test",
                "type"          => 0,
                "dlr"           => 1,  //0: No delivery report required 1: delivery report required
                "destination" => $phone, //"96594971095"
                "source"        => "EVEGATEKW",
                "message"       =>
                __('authentication::api.register.messages.code_send', ["code" => $message], 'en'),
            ];

            return $this->request($data);
        } catch (\Exception $e) {
            return ["Result" => "false"];
        }
    }

    public function request($data)
    {


        $ch = curl_init();

        $query = str_replace("password-test", env('SMS_BOX_PASSWORD'), http_build_query($data));


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api.rmlconnect.net/bulksms/bulksms?$query");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        return $this->parse($result);
    }

    public function parse($result)
    {
        $result = str_replace(["\n", "\r", "\t"], '', $result);
        $result = trim(str_replace('"', "'", $result));
        $result = explode('|', $result);
        $r['status_code'] = $result[0];
        $r['mobile']      = $result[1];
        $r['message_id']  = $result[2];
        $r['Result']      = $r['status_code'] == '1701'; //1701 =>Success
        return $r;
    }
}
