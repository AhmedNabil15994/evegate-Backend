<?php

return [
    "verified" => [
        "not_verifed" => "You need to verify the account",
        "not_active"  => "This account is temporarily suspended by the admin",
        "not_admin_verified" => "Account Not accept from adminstration yet",
    ],
    'forget_password'   => [
        'mail'      => [
            'subject'   => 'Reset Password',
        ],
        'messages'  => [
            'success'   => 'Reset Password Send Successfully',
            'success-mobile'   => 'code verified send successfully ',
            "reset"         => "Password reset successfully"
        ],
    ],
    'login'             => [
        'validation'    => [
            'email'     => [
                'email'     => 'Please enter correct email format',
                'required'  => 'The email field is required',
            ],
            'failed'    => 'These credentials do not match our records.',
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'The password field is required',
            ],
            "code_verified" => [
                "not_correct" => "code verified not correct"
            ]
        ],
    ],
    'logout'            => [
        'messages'  => [
            'failed'    => 'logout failed',
            'success'   => 'logout successfully',
        ],
    ],
    'delete_Account'            => [
        'messages'  => [
            'failed'    => 'logout failed',
            'success'   => 'account deleted successfully',
        ],
    ],
    "resend" => [
        "success" => "successfully send code"
    ],
    'password'          => [
        'messages'      => [
            'sent'  => 'Reset password sent successfully',
        ],
        'validation'    => [
            'email' => [
                'email'     => 'Please enter correct email format',
                'exists'    => 'This email not exists',
                'required'  => 'The email field is required',
            ],
        ],
    ],
    'register'          => [
        'messages'      => [
            'failed'    => 'Register Failed , Please try again later',
            "error_sms" => "ُError in sms messges sender",
            "code_send" => "Your verification code is: :code ",
            "code"      => "verification code not correct",
        ],
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
    'reset'             => [
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
    'workers'       => [
        'mail'          => [
            'btn'               => 'Show the new worker',
            'header'            => 'New worker Registered from our app & waiting for the activation ',
            'subject'           => 'New worker Registered ',
        ],
    ],
];
