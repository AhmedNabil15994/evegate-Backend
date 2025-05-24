<?php

namespace Modules\Authentication\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PasswordReset;
use Illuminate\Validation\ValidationException;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Http\Requests\Frontend\ResetPasswordRequest;
use Modules\Authentication\Http\Requests\Frontend\ResetPasswordMobileRequest;
use Modules\Authentication\Repositories\Frontend\AuthenticationRepository as AuthenticationRepo;

class ResetPasswordController extends Controller
{
    use Authentication;

    public function __construct(AuthenticationRepo $auth)
    {
        $this->auth = $auth;
    }

    public function resetPassword($token)
    {
        abort_unless(PasswordReset::where([
            'token' => $token
        ])->first(), 419);
        
       
        return view('authentication::frontend.auth.passwords.reset', compact('token'));
    }


    public function updatePassword(ResetPasswordRequest $request)
    {
        abort_unless(PasswordReset::where([
            'token' => $token,
            'email' => request('email'),
        ])->first(), 419);

        $reset = $this->auth->resetPassword($request);

        // $errors =  $this->login($request);

        // if ($errors)
        //     return redirect()->back()->withErrors($errors)->withInput($request->except('password'));

        return view('authentication::frontend.auth.passwords.reset')->with(['status'=>'Password Reset Successfully']);
    }

    public function resetUsingMobile(Request $request)
    {
        return view('authentication::frontend.auth.reset');
    }

    public function resetUsingMobileSave(ResetPasswordMobileRequest $request)
    {
        $user = $this->auth->findUser($request->mobile, $request->phone_code);

        if ($user->code_verified != $request->code) {
            throw ValidationException::withMessages(
                ["code" => __('authentication::api.register.messages.code')]
            );
        }
        
        $user->update(["password"=> bcrypt($request->password)]);
        
        return redirect()->route("frontend.login")->withMessage(__('authentication::api.forget_password.messages.reset'));
    }
}
