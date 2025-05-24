<?php

namespace Modules\Authentication\Http\Controllers\Api\UserApp;

use Illuminate\Http\Request;
use Modules\User\Enums\UserType;
use Modules\User\Transformers\Api\UserResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Http\Requests\Api\UserApp\RegisterRequest;
use Modules\Authentication\Repositories\Api\UserApp\AuthenticationRepository as AuthenticationRepo;

class RegisterController extends ApiController
{
    use Authentication;
    public $auth;

    public function __construct(AuthenticationRepo $auth)
    {
        $this->auth = $auth;
    }

    public function register(RegisterRequest $request)
    {
        $registered = $this->auth->register($request);
        $sendSms = false;
        if ($registered) {
            // $sendSms =  $this->auth->sendSms($registered);
            return $this->reponseData($registered, $sendSms);
        } else {
            return $this->error(__('authentication::api.register.messages.failed'), [], 401);
        }
    }


    public function reponseData($user = null, $sms_sent = false)
    {
        $user = $user ? $user : auth()->user();
        $token = $this->generateToken($user);
        $user->load(UserType::load($user));


        return $this->response([
            'access_token' => $token->accessToken,
            'user'         => new UserResource($user),
            'token_type'   => 'Bearer',
            // "code"          => $user->code_verified,
            'expires_at'   => $this->tokenExpiresAt($token),
            "sms_send"     => $sms_sent
        ]);
    }
}
