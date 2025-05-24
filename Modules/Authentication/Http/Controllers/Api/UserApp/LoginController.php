<?php

namespace Modules\Authentication\Http\Controllers\Api\UserApp;

use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Modules\User\Enums\UserType;
use Modules\User\Transformers\Api\UserResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Authentication\Foundation\{Authentication,MobileAuthentication};
use Modules\Authentication\Http\Requests\Api\UserApp\LoginRequest;
use Modules\Authentication\Http\Requests\Api\UserApp\ResendCodeRequest;
use Modules\Authentication\Http\Requests\Api\UserApp\LoginMobileRequest;
use Modules\Authentication\Http\Requests\Api\UserApp\VerifiedCodeRequest;
use Modules\Authentication\Repositories\Api\UserApp\AuthenticationRepository;

class LoginController extends ApiController
{
    use Authentication,MobileAuthentication;

    public $user;

    public function __construct(AuthenticationRepository $user)
    {
        $this->user = $user;
    }

    public function postLogin(LoginRequest $request)
    {
        $user =  $this->loginApp($request);

        if ($user instanceof User) :
            $user->load(["company"]);
            return $this->tokenResponse($user);
        endif;
        return $this->invalidData($user, [], 422);
    }


    public function postLoginMobileOrMail(LoginRequest $request)
    {
        $user =  $this->loginAppOrMobile($request);

        if ($user instanceof User) :
            $user->load(["company"]);
            return $this->tokenResponse($user);
        endif;
        return $this->invalidData($user, [], 422);
    }



    public function postMobileLogin(LoginMobileRequest $request)
    {
        $user =  $this->loginAppMobile($request);
        if ($user instanceof User) :
            $user->load(["company"]);
            return $this->tokenResponse($user);
        endif;
        return $this->invalidData($user, [], 422);
    }


    public function tokenResponse($user = null)
    {
        $user = $user ? $user : auth()->user();

        $user->loadMissing(UserType::load($user));

        $token = $this->generateToken($user);

        return $this->response([
            'access_token' => $token->accessToken,
            'user'         => new UserResource($user),
            'token_type'   => 'Bearer',
            'expires_at'   => $this->tokenExpiresAt($token)
        ]);
    }

    public function logout(Request $request)
    {
        $this->user->resetDevciceToken(auth()->user());
        $user = auth()->user()->token()->revoke();

        return $this->response([], __('authentication::api.logout.messages.success'));
    }

    public function resendCode(ResendCodeRequest $request)
    {
        $user = $this->user->findUserForResendCode($request->mobile, $request->phone_code);

        if ($user) {

            if ($this->user->resendCode($user)) {
                return $this->response([
                    "code_verified" => config("app.env") != "production" ?  $user->code_verified : true
                ], __('authentication::api.resend.success'));
            }
            return $this->error(__('authentication::api.register.messages.error_sms'), [], 420);

        }else{

            $otpRequest = $this->sendOtp($request->phone_code,$request->mobile);

            return $this->response([
                "code_verified" => config("app.env") != "production" ?  $otpRequest->otp : true
            ], __('authentication::api.resend.success'));
        }
    }

    public function verified(VerifiedCodeRequest $request)
    {
        $user = $this->user->findUser($request->mobile, $request->phone_code);

        if ($user) {
            if ($user->code_verified == $request->code) {
                $user->update(["code_verified" => null, "is_verified" => true]);
                // if not get token needed
                if ($request->not_get_token) {
                    return $this->response([
                        'user'         => new UserResource($user),
                    ]);
                }
                return $this->tokenResponse($user);
            }
            return $this->error(__('authentication::api.register.messages.code'), [], 420);
        }

        return  $this->error(__('authentication::api.register.messages.failed'), [], 401);
    }

    public function deleteAccount(Request $request)
    {
        $this->user->resetDevciceToken(auth()->user());
        $user = auth()->user()->token()->revoke();

        $user = $request->user()->delete();

        return $this->response([], __('authentication::api.delete_Account.messages.success'));
    }
}
