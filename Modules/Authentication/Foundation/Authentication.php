<?php

namespace Modules\Authentication\Foundation;

use Auth;
use Exception;
use Carbon\Carbon;
use Modules\User\Entities\User;
use Illuminate\Support\MessageBag;

trait Authentication
{
    public static function authentication($credentials)
    {
        $auth = null;
        // LOGIN BY : Mobile & Password
        if (is_numeric($credentials->email)) :

            $auth = Auth::attempt(
                [
                    'mobile'     => $credentials->email,
                    'password'   => $credentials->password
                ],
                $credentials->has('remember')
            );

        // LOGIN BY : Email & Password
        elseif (filter_var($credentials->email, FILTER_VALIDATE_EMAIL)) :

            $auth = Auth::attempt(
                [
                    'email'     => $credentials->email,
                    'password'  => $credentials->password
                ],
                $credentials->has('remember')
            );

        endif;

        return $auth;
    }

    public function login($credentials)
    {
        try {


            // dd(self::authentication($credentials), auth()->user()->isAbleTo('workers_access') || auth()->user()->isAbleTo('dashboard_access') );
            if (self::authentication($credentials) &&  auth()->user()->isAbleTo('dashboard_access')) {
                return false;
            }


            $errors = new MessageBag([
                'password' => __('authentication::dashboard.login.validations.failed')
            ]);

            auth()->logout();

            return $errors;
        } catch (Exception $e) {
            throw $e;
            return $e;
        }
    }

    public function loginWeb($credentials)
    {
        try {


            // dd(self::authentication($credentials), auth()->user()->isAbleTo('workers_access') || auth()->user()->isAbleTo('dashboard_access') );
            if (self::authentication($credentials)) {
                return false;
            }


            $error = new MessageBag([
                'password' => __('authentication::frontend.login.validation.failed')
            ]);

            return $error;
        } catch (Exception $e) {
            throw $e;
            return $e;
        }
    }

    public function loginVendor($credentials)
    {
        try {


            // dd(self::authentication($credentials), auth()->user()->isAbleTo('workers_access') || auth()->user()->isAbleTo('dashboard_access') );
            if (self::authentication($credentials) && auth()->user()->isAbleTo('worker_access') && auth()->user()->type == "worker") {
                return false;
            }


            $errors = new MessageBag([
                'password' => __('authentication::dashboard.login.validations.failed')
            ]);

            auth()->logout();

            return $errors;
        } catch (Exception $e) {
            throw $e;
            return $e;
        }
    }

    public function loginAfterRegister($credentials)
    {
        try {
            self::authentication($credentials);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function generateToken($user)
    {
        if (config("app.one_token")) {
            $user->tokens()->delete();
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return $tokenResult;
    }

    public function tokenExpiresAt($token)
    {
        return Carbon::parse($token->token->expires_at)->toDateTimeString();
    }

    public function loginApp($credentials)
    {

        try {
            $credentials = [
                "email"        => $credentials->email,
                'password'    => $credentials->password
            ];

            $user = auth()->once($credentials);


            if ($user) {
                $user = auth()->user()
                    ->loadCount(['ads' => fn ($q) => $q->allowShow()]);
                if ($user->is_active) {
                    return $user;
                }

                return new MessageBag([
                    'email' => __('authentication::dashboard.login.validations.block')
                ]);
            }



            return new MessageBag([
                'email' => __('authentication::dashboard.login.validations.failed')
            ]);
        } catch (Exception $e) {
            throw $e;
            return $e;
        }
    }

    public function loginAppOrMobile($credentials)
    {

        $loginCredentials = [
            "email"  => "",
            "password" => ""
        ];
        // LOGIN BY : Mobile & Password
        if (is_numeric($credentials->email)) :
            $loginCredentials   = [
                'mobile'        => $credentials->email,
                "phone_code"    => $credentials->phone_code,
                'password'      => $credentials->password
            ];
        // LOGIN BY : Email & Password
        elseif (filter_var($credentials->email, FILTER_VALIDATE_EMAIL)) :
            $loginCredentials   = [
                'email'     => $credentials->email,
                'password'   => $credentials->password
            ];
        endif;

        $user = auth()->once($loginCredentials);


        if ($user) {
            $user = auth()
                ->user()
                ->loadCount(['ads' => fn ($q) => $q->allowShow()]);
            if ($user->is_active) {
                return $user;
            }

            return new MessageBag([
                'email' => __('authentication::dashboard.login.validations.block')
            ]);
        }



        return new MessageBag([
            'email' => __('authentication::dashboard.login.validations.failed')
        ]);
    }

    public function loginAppMobile($credentials)
    {

        try {
            $credentials = [
                "phone_code"        => $credentials->phone_code,
                "mobile"            => $credentials->mobile,
                'password'         => $credentials->password
            ];

            $user = auth()->once($credentials);


            if ($user) {
                $user = auth()
                    ->user()
                    ->loadCount(['ads' => fn ($q) => $q->allowShow()]);
                if ($user->is_active) {
                    return $user;
                }

                return new MessageBag([
                    'mobile' => __('authentication::dashboard.login.validations.block')
                ]);
            }



            return new MessageBag([
                'mobile' => __('authentication::dashboard.login.validations.failed')
            ]);
        } catch (Exception $e) {
            throw $e;
            return $e;
        }
    }
}
