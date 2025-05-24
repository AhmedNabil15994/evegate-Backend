<?php

namespace Modules\Authentication\Repositories\Api\UserApp;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Modules\QSale\Ws\WsSender;
use Modules\User\Entities\User;
use Modules\User\Enums\UserType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Packages\SMS\SmsGetWay;
use Modules\User\Entities\PasswordReset;

class AuthenticationRepository
{
    public $password;
    public $user;
    public $sms;
    public $wsSender;

    public function __construct(User $user, PasswordReset $password, SmsGetWay $sms)
    {
        $this->password  = $password;
        $this->user      = $user;
        $this->sms       = $sms;
        $this->wsSender       = new WsSender;
    }

    public function register($request)
    {
        DB::beginTransaction();

        $have_sms = config("app.have_sms");

        try {
            $image = $request['image'] ? pathFileInStorage($request, "image", "users") : "/uploads/users/user.png";
            $user = $this->user->create([
                'name'          => $request['name'],
                'email'         => $request['email'],
                "phone_code"    => $request->phone_code,
                'mobile'        => $request['mobile'],
                "type"          => $request->type,
                "is_verified"   => $have_sms ? false : true,
                "firebase_uuid" => $request->firebase_uuid,
                "code_verified" => $have_sms ?  generateRandomCode(5) : null,
                'password'      => $request->password ? Hash::make($request['password']) : "",
                // "admin_verified" => in_array($request->type, [UserType::USER]),
                "admin_verified" => true,
                'image'         => $image,
                'country_id'         => $request->country_id ?? config("customs.country_id"),
                "setting"      => [
                    "lang" => locale()
                ]
            ]);

            if (is_callable([UserType::class, $user->type])) {
                (new UserType)->{$user->type}($user, $request);
            }

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function findUserByEmail($request)
    {
        $user = $this->user->where('email', $request->email)->first();
        return $user;
    }






    public function createToken($request)
    {
        $user = $this->findUserByEmail($request);

        $this->deleteTokens($user);

        $newToken = strtolower(Str::random(64));




        $token =  $this->password->updateOrCreate(['email'       => $user->email], [
            'email'       => $user->email,
            'token'       => $newToken,
            'created_at'  => Carbon::now(),
        ]);

        $data = [
            'token' => $newToken,
            'user'  => $user
        ];

        return $data;
    }

    public function resetPassword($request)
    {
        $user = $this->findUserByEmail($request);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $this->deleteTokens($user);

        return true;
    }

    public function deleteTokens($user)
    {
        $this->password->where('email', $user->email)->delete();
    }

    public function findUser($mobile, $phone_code)
    {
        return  $this->user->where(
            [
                'mobile'       => $mobile,
                'phone_code'   => $phone_code
            ]
        )->firstOrFail();
    }

    public function findUserForResendCode($mobile, $phone_code)
    {
        return  $this->user->where(
            [
                'mobile'       => $mobile,
                'phone_code'   => $phone_code
            ]
        )->first();
    }

    public function resendCode($user)
    {
        $user->update([
            "code_verified" => generateRandomCode(5)
        ]);

        return $this->sendWs($user);
    }

    public function resetDevciceToken($user)
    {
        $user->deviceTokens()->update([
            "user_id" => null
        ]);
    }

    public function sendSms($user)
    {
        $result =  $this->wsSender->sendOtp($user->code_verified, $user->getPhone());
        return $result["Result"] == "true";
    }

    public function sendWs($user)
    {
        \Message::send([
            'phone' =>  $user->getPhone(),
            'body'  => 'Your Verification OTP is : ' . $user->code_verified,
        ]);
        return true;
    }
}
