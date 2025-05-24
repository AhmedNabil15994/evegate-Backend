<?php

return [
   
    'workers'         => [
        'create'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General Info.',
                'image'             => 'Profile Image',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Password',
                "country"           => "Country",
                "restore"           => "Restore",
                "user_name"         =>  "User Name" ,
                "status"            => "Status", 
                "branch_id"          => "Branch" ,
                "vendor_id"           => "Vendor " , 
                "worker"            =>  "Teller store Info"
            ],
            'title' => 'Create Worker',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            "status"            => "Status", 
           
            "weak"          => [
                "monday"   => "Monday",
                "tuesday"  => "Tuesday"  ,
                "wednesday"=> "Wednesday" ,
                "thursday" => "Thursday" ,
                "friday"    => "Friday" ,
                "saturday"  => "Saturday" ,
                "sunday"    => "Sunday"
            ],
          
            'mobile'        => 'Mobile',
            'name'          => 'Name',
            'options'       => 'Options',
           
        ],
        'index'     => [
            'title' => 'Workers',
        ],
        'update'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General Info.',
                'image'             => 'Profile Image',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Password',
                "country"           => "Country",
                "restore"           => "Restore",
                "user_name"         =>  "User Name" ,
                "status"            => "Status", 
                "branch_id"          => "Branch" ,
                "vendor_id"           => "Vendor " , 
                "worker"            =>  "Teller store Info"
            ],
            'title' => 'Update Worker',
        ],
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
            ],
            'name'      => [
                'required'  => 'Please enter the name of user',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of user',
                'same'      => 'The Password confirmation not matching',
            ],
        ],
    ],
    
   
];
