<?php

namespace Modules\Authentication\Http\Controllers\Api\UserApp;

use Illuminate\Http\Request;
use Modules\User\Transformers\Api\UserResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Authentication\Notifications\Api\ResetPasswordNotification;
use Modules\Authentication\Http\Requests\Api\UserApp\ForgetPasswordRequest;
use Modules\Authentication\Http\Requests\Api\UserApp\ResetPasswordMobileRequest;
use Modules\Authentication\Http\Requests\Api\UserApp\ForgetPasswordMobileRequest;
use Modules\Authentication\Repositories\Api\UserApp\AuthenticationRepository as Authentication;

class ForgotPasswordController extends ApiController
{
    function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $token = $this->auth->createToken($request);

        $token['user']->notify((new ResetPasswordNotification($token))->locale(locale()));

        return $this->response([], __('authentication::api.forget_password.messages.success'));
    }

    public function forgetPasswordMobile(ForgetPasswordMobileRequest $request)
    {
        $user = $this->auth->findUser($request->mobile, $request->phone_code);
        $code =  $this->auth->resendCode($user);

        return $this->response(['code' => $code], __('authentication::api.forget_password.messages.success-mobile'));
    }

    public function resetPasswordMobile(ResetPasswordMobileRequest $request)
    {
        $user = $this->auth->findUser($request->mobile, $request->phone_code);
        if ($user->code_verified != $request->code) {
            return $this->error(__('authentication::api.login.validation.code_verified.not_correct'));
        }

        $user->update(["password" => bcrypt($request->password)]);

        return $this->response([], __('authentication::api.forget_password.messages.reset'));
    }
}
