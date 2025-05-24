<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    "recaptcha"=>[
        "sitekey" => env("RECAPTCHAV2_SITEKEY", "6LcmJr4bAAAAAHxfmoGwym1cobRvncnN70a8-nOH") ,
        "secret"  => env("RECAPTCHAV2_SECRET", "6LcmJr4bAAAAAA_QPabul5kqf-wigcBBO3yQPZD0") ,
    ],
    "payment"=>[
        "default" => env("PAYMENT_DEFAULT", "knet"),
        "my_fatoorah" => [
            "secret_api_key_test"=>"rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL"    ,
            "secret_api_key_live"=>"NlIB9_N-Nc0FVckMXpX4KceGrHnAVFd7dPnaPqvKHXAljRy2g1D_L7QEz83rVABG-9XHr6hgswj3BnKi9eXjdw4hj6FX85hVb0jQQ0ZtxacYyZPuxWOKsEhBqQM6yCKT2oQ0_3UjpHCwYlTB1tGhJ1lcZgsZHykcqcU_VYLEeX3Sn2vI1qbJnC1_Zw_QZIeGcZKT8hnPb0bh09xE1UW3NWZPDG1xqzlV3Fiu5Nhxjp6r1n4azZKTUOekrznbEbFCkazaTw1Dfxe5kQIreGBhS0hcH_o72mX8FIpew5q2XjuqfNshbqrLCgKqmZC8T9BJP4h5A4s19zFyxeXXK4ktDk0V3o3VWkSX2uWmtQpRrJpD_cST-Q64cqW9cUpUrvH3ATy8xxOOmGCGUiN5c8BS84UzGOOKs00uHjiTXLhbdzDHtU1_CA68tEl6xXgPB36KzUPPgfgNUTeDgZl6dgGynf05l23uwt3-cW0JMZgfOx6ucggUYq1lDHYB19ArLAcfu_vO1Cc1Pw_5VKaMwkob6ZpS7hQLYUzECjQltrHsY6i0a9soj-OI4Ue1OowfXAHfgvUEcNQivXzLR-8tP11Cl_VJV4FnmMI4ywYu52I8poVuXhvJbEFe11hPjqsQSnYlAtrS-n08k_Hn8-jpN3RoWd3hicv_5f-6hyPFRi3XnJgXGCGC"
        ],
        "knet"=>[
            "merchant_id" => env("PAYMENT_MERCHANT_ID", 679) ,
            "username"    =>  env("PAYMENT_USERNAME", "tocaan"),
            "password"    => env("PAYMENT_PASSWORD", "ml4nf9wx2utuogcr"),
            "api_key"     => env("PAYMENT_API_KEY", "nLuf1cAgcx2KFEViDSzxN785vXqlNx4FawQaQ086"),
            "iban_number" => env("PAYMENT_IBAN_NUMBER", "KW02COMB0000509586643100414012"),//"KW51BBYN0000000000000381563005",
            "charge_type" => env("PAYMENT_CHARGE_Type", "fixed") ,
            "charge_amount"=>env("PAYMENT_CHARGE_AMOUNT", .300)  ,
            "cc_chargeType"=>env("PAYMENT_CC_CHARGE_TYPE", "percentage"),
            "cc_charges"   => env("PAYMENT_CC_CHARGE_AMOUNT", 3.4),
            "url"           => env("PAYMENT_CHARGE_URL", "https://api.upayments.com/payment-request")
        ]
        ],
    "sms"=>[
        "default" => env("SMS_DEFAULT", "sms_box"),
        "test"    => env("SMS_TEST", false),
        "sms_box"=>[
            "username" => env("SMS_BOX_USERNAME", "test"),
            "password" => env("SMS_BOX_PASSWORD", "password") ,
            "customerId"=> env("SMS_BOX_CUSTOMER_ID", "3117") ,
            "senderText"=> env("SMS_BOX_SENDER_TEXT", "test"),
            "defdate"   => env("SMS_BOX_DEF_DATE", ""),
            "isBlink"  => env("SMS_BOX_IS_BLINK", "false"),
            "isFlash"  => env("SMS_BOX_IS_FLASH", "false"),
        ],
        "sms_box_new"=>[
            "username" => env("SMS_BOX_USERNAME", "test"),
            "password" => env("SMS_BOX_PASSWORD", "password") ,
            "senderText"=> env("SMS_BOX_SENDER_TEXT", "test"),
        ],
        ],
        "allow_bugsnag"=> env("BUGSNAG_ALLOW", false) ,
        "fcm"=>[
            "server"=> env("FCM_SERVER", 'AAAAGLfNv0c:APA91bGjn5R8p-6AnDpw5MUenylixXx7LfR05oyzmrD6Q0O5Mg0Mhud0Lz_OqRqxha17mmQXXwE3h0iXFWlcgrp7bIrW3fiMdvmjBtm4kAI6arq2Icmew3B7BdlYu5yquEz1x93yqL4U')
        ]

];
