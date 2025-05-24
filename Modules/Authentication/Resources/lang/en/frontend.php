<?php

return [
    'login'     => [
        "content" => [
            "msg_side_head" => "Advertise your assets Buy what are you needs" ,
            "msg_side_content"=> "Biggest Online Advertising Marketplace in the World"
        ],
        'form'          => [
            'btn'           => [
                'forget_password'   => 'Forget Password ?',
                'login'             => 'Login',
            ],
            'email'         => 'E-mail address',
            'mobile'         => 'Mobile Or Email',

            'password'      => 'Password',
            'remember_me'   => 'Remember Me',
            "msg" =>  "Welcome!",
            "desc" =>  "Use credentials to access your account .",
            "footer_note"=>"Don't have an account? click on the" ,
            "footer_note2"=> " button above."
        ],
        'title'         => 'Login',
        "auth_must"     =>"You must login or register as a new member first.",
        'validation'    => [
            'email'     => [
                'email'     => 'Please enter correct email format',
                'required'  => 'The email or mobile field is required',
                     
            ],
            'failed'    => 'These credentials do not match our records.',
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'The password field is required',
            ],
        ],
    ],
    'password'  => [
        'alert'         => [
            'reset_sent'    => 'Reset password sent successfully',
        ],
        'form'          => [
            'btn'   => [
                'password'  => 'Send Reset Password',
            ],
            'email' => 'Email address',
        ],
        'title'         => 'Forget Password',
        'validation'    => [
            'email' => [
                'email'     => 'Please enter correct email format',
                'exists'    => 'This email not exists',
                'required'  => 'The email field is required',
            ],
        ],
    ],
    'register'  => [
        'alert'         => [
            'policy_privacy'    => 'if you register it mean you are confirm',
        ],
        'btn'           => [
            'policy_privacy'    => 'Policy & Privacy',
            'register'          => 'Register',
        ],
        'form'          => [
            'email'                 => 'Email Address',
            'mobile'                => 'Mobile',
            'name'                  => 'Username',
            'password'              => 'Password',
            'password_confirmation' => 'Password Confirmation',
            "msg" => "Setup a new account in a minute." ,
            "agree"=>"I agree to the all",
            "footer_note"=>"Already have an account? click on the " ,
            "footer_note2"=> " button above."
        ],
        'title'         => 'Registration',
        'validation'    => [
            'email'     => [
                'email'     => 'Please enter correct email format',
                'required'  => 'The email field is required',
                'unique'    => 'The email has already been taken',
            ],
            'mobile'    => [
                'digits_between'    => 'You must enter mobile number with 8 digits',
                'numeric'           => 'The mobile must be a number',
                'required'          => 'The mobile field is required',
                'unique'            => 'The mobile has already been taken',
            ],
            'name'      => [
                'required'  => 'The name field is required',
            ],
            'password'  => [
                'confirmed' => 'Password not match with the cnofirmation',
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'The password field is required',
            ],
        ],
    ],
    'reset'     => [
        'form'          => [
            'btn'                   => [
                'reset' => 'Reset Password Now',
            ],
            'email'                 => 'Email Address',
            'password'              => 'Password',
            'password_confirmation' => 'Password Confirmation',
        ],
        'mail'          => [
            'button_content'    => 'Reset Your Password',
            'header'            => 'You are receiving this email because we received a password reset request for your account.',
            'subject'           => 'Reset Password',
        ],
        'title'         => 'Reset Password',
        'validation'    => [
            'email'     => [
                'email'     => 'Please enter correct email format',
                'exists'    => 'This email not exists',
                'required'  => 'The email field is required',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'The password field is required',
            ],
            'token'     => [
                'exists'    => 'This token expired',
                'required'  => 'The token field is required',
            ],
        ],
    ],
];
