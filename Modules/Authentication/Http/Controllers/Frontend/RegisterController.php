<?php

namespace Modules\Authentication\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Http\Requests\Frontend\RegisterRequest;
use Modules\Authentication\Repositories\Frontend\AuthenticationRepository as AuthenticationRepo;

class RegisterController extends Controller
{
    use Authentication;

    public function __construct(AuthenticationRepo $auth)
    {
        $this->auth = $auth;
    }

    

    public function register(RegisterRequest $request)
    {
        $registered = $this->auth->register($request);

        if ($registered):

              $this->loginAfterRegister($request);
        if (auth()->user()->is_verified) {
            return redirect()->route('frontend.home');
        } else {
            return redirect()->route('frontend.user.verify');
        } else:

            return redirect()->back()->with(['errors'=>'try again']);

        endif;
    }
}
