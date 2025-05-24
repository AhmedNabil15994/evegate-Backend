<?php

return [
    'users'     => [
        'validation'=> [
            'email'     => [
                'required'  => 'Please enter the email of user',
                'unique'    => 'This email is taken before',
            ],
            'mobile'    => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of user',
                'unique'            => 'This mobile is taken before',
                'exists'            => 'This mobile or OTP is wrong',
            ],
            'name'      => [
                'required'  => 'Please enter the name of user',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of user',
                'same'      => 'The Password confirmation not matching',
                "not_correct"=>"The current password is incorrect.",
            ],
            "deposit" =>[
                "empty" => "Can't make request beacuse not have money"
            ]
        ],
        "user_not_have_role" => "user type not have the permmission to do it",
       
    ],
];
