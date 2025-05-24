<?php

namespace Modules\Authentication\Foundation;

use Illuminate\Support\Facades\Auth;
use Modules\Authentication\Entities\OtpRequest;
use Modules\User\Entities\User as Client;
use Modules\User\Transformers\Api\ClientResource;
use Helper\Translation;
use Helper\Response;
use Illuminate\Http\Request;

trait MobileAuthentication
{
    public static function sendOtp($phoneCode,$mobile)
    { 
        optional(OtpRequest::where('mobile' , $mobile)->where('phone_code', $phoneCode)->first())->delete();
        return OtpRequest::create(['mobile' => $mobile,'phone_code' => $phoneCode]);
    }
    public static function otpCheck($phoneCode,$mobile,$otp)
    { 
        $request =  OtpRequest::where(['mobile' => $mobile,'otp' => $otp,'phone_code' => $phoneCode])->first();
        return $request && !$request->is_expired;
    }
}
