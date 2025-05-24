<?php

return [
    'contact_us'    => [
        'alerts'        => [
            'send_message'  => 'Message Sent Successfully',
        ],
        'form'          => [
            'btn'       => [
                'send'  => 'Send',
            ],
            'email'     => 'Email',
            'message'   => 'Message',
            'mobile'    => 'Mobile',
            'username'  => 'Username',
        ],
        'info'          => [
            'email' => 'Email address',
            'mobile'=> 'Mobile',
            'title' => 'Informations',
        ],
        'mail'          => [
            'header'    => 'We received new contact us mail',
            'subject'   => 'Contact Us Mail',
        ],
        'suggest'          => [
            'header'    => 'We received new Suggest  mail',
            'subject'   => 'Suggest Mail',
        ],
        'title'         => 'Contact Us',
        'title_2'       => 'Send message for us',
        "make_call"=>"Make a Call" ,
        "send_email" => "Send Email" ,
        'validations'   => [
            'email'     => [
                'email'     => 'Please enter correct email',
                'required'  => 'Please enter the email address',
            ],
            'message'   => [
                'min'       => 'Message must be more than 10 characters',
                'required'  => 'Please fill the message of contact us',
                'string'    => 'please enter only characters and numbers in message',
            ],
            'mobile'    => [
                'digits_between'    => 'You must enter mobile number with 8 digits',
                'numeric'           => 'Please enter correct mobile number',
                'required'          => 'Please enter mobile number',
            ],
            'username'  => [
                'min'       => 'Username must be more than 3 character',
                'required'  => 'Please enter username',
                'string'    => 'Please enter username with only characters and numbers',
            ],
        ],
    ],

    "layout" => [
        "footer" => [
             "information" => "Information" ,
             "quick_links" => "Quick Links" ,
             "contact_us"    => "Contact Us" ,
             "copyrights"    => "All Copyrights Reserved",   
             "developed_by"  => "Developed by",
             "register_users"=> "Registered Users" ,
             "community_ads"  => "Community Ads"   ,
             "choose_langue" => "Choose a Language" , 
 
        ] ,
        "header" => [
             "search" => "Search, Whatever you needs...",
             "post_ads" => "Post Your Ad" ,
             "join_now" => "Join Me" ,
             "search"   => "Search"
        ],
        "aside" => [
            "post_ads" => "Post Your Ad" ,
            "author_menu" => "User Menu" ,
            "main_menu"    => " Main Menu" ,
            "logout"       => "Logout", 
            "profile"      => "Profile", 
            "my_ads"       => "My Ads"   ,
            "favorite"     => "Favorite" ,
            "category_list"=> "Category List" ,
            "contact_us"   => "Contact Us "  ,
            "ads_list"     => "Ads"
        ]
        ],
        "home"=>[
            "recommend"  => "Recommend"   ,
            "ads"        => "Ads", 
            "all"           => "Show All",
            "must_auth"  => "Must be login to do this action "    ,
            "route"      => "Home",
           "login"      => "Login",
            "button_all"     => "Show All Ads",
            "header_msg" => "You can #Buy, #Rent, #Booking anything from here." ,
            "header_content" => "Buy and sell everything from used cars to mobile phones and computers, or search for property, jobs and more in the world."
    ]


    
 

];
