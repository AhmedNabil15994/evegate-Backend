<?php

namespace Modules\Authentication\Http\Controllers\Api\UserApp;

use Illuminate\Http\Request;
use Modules\User\Transformers\Api\UserResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Authentication\Http\Requests\Api\UserApp\ResendCodeRequest;

use Modules\Authentication\Http\Requests\Api\UserApp\ResetPasswordFireBaseRequest;
use Modules\Authentication\Repositories\Api\UserApp\AuthenticationRepository as Authentication;

class FireBaseController extends ApiController
{
    function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function checkMobile(ResendCodeRequest $requst){

        return $this->response([]);
    }
 
    public function resetPassword(ResetPasswordFireBaseRequest $request)
    {
        $user = $this->auth->findUser($request->mobile, $request->phone_code);
        
        $user->update(["password"=> bcrypt($request->password)]);

        
        return $this->response([], __('authentication::api.forget_password.messages.reset') );
    }
}
