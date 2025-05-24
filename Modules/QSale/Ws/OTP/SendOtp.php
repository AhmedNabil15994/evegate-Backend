<?php

namespace Modules\QSale\Ws\OTP;

trait SendOtp
{
    private $otpRoute = "ws/send-message";

    public function sendOtp(string $OTP, string $phone)
    {
        return $this->post($this->otpRoute, [
            'message' => __('authentication::api.register.messages.code_send', ["code" => $OTP]),
            'mobile_number' => $phone,
        ]);
    }
}
