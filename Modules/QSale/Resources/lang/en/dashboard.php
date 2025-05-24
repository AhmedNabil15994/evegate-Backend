<?php

return [
    'coupons'  => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'options'       => 'Options',
            'status'        => 'Status',
            "code"         => "Code",
            'min'              => 'Min value',
            'max'               => 'Max value when percent',
            "amount"            => "Discount",
            "expired_at"        => "expired at",
            "max_use"           => "Max use",
            "current_use"       => "Current use",
            "max_use_user"      => "Max use user",
            "is_fixed"          => "Is fixed",

        ],
        'form'      => [
            'status'        => 'Status',
            "code"         => "Code",
            'min'              => 'Min value',
            'max'               => 'Max value when percent',
            "amount"            => "Discount",
            "expired_at"        => "expired at",
            "max_use"           => "Max use",
            "current_use"       => "Current use",
            "max_use_user"      => "Max use user",
            "is_fixed"          => "Is fixed",
            "packages"          => "packages",
            'tabs'              => [
                'general'   => 'General Info.',
            ],

        ],
        'routes'    => [
            'create'    => 'Create Coupon',
            'index'     => ' Coupons ',
            'update'    => 'Edit Coupon',
        ],
        'validation' => [
            "not_valid" => "Coupon No Valid"
        ],
    ],
    'packages'  => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'options'       => 'Options',
            'status'        => 'Status',
            "is_free"       => "Is free",
            "title"       => "Title",
            "description" => "Description",
            "price"     => "Price",
            "duration"  => "Duration",
            "number_of_ads" => "Number of ads",
            "number_of_image" => "Number of image",
            "duration_of_ads"  => "Duration of ads",

        ],
        'form'      => [
            'status'        => 'Status',
            "is_free"       => "Is free",
            "title"       => "Title",
            "description" => "Description",
            "price"     => "Price",
            "duration"  => "Duration",
            "number_of_ads" => "Number of ads",
            "number_of_image" => "Number of image",
            "duration_of_ads"  => "Duration of ads",
            "sort"          => "sort ",
            "first_time" => "First Time",
            "type"       => "Package Type",
            "types"      => [
                "user"      => "User",
                "company"   => "Company",
                "technical" => "Technical",
            ],
            'tabs'              => [
                'general'   => 'General Info.',
            ],

        ],
        'routes'    => [
            'create'    => 'Create Package',
            'update'     => 'Edit  Package',
            'index'    => 'packages',
        ],

    ],
    'republished_packages'  => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'options'       => 'Options',
            'status'        => 'Status',
            "is_free"       => "Is free",
            "title"       => "Title",
            "description" => "Description",
            "price"     => "Price",
            "duration"  => "Duration",


        ],
        'form'      => [
            'status'        => 'Status',
            "is_free"       => "Is free",
            "title"       => "Title",
            "description" => "Description",
            "price"     => "Price",
            "duration"  => "Duration",
            'tabs'              => [
                'general'   => 'General Info.',
            ],

        ],
        'routes'    => [
            'create'    => 'Create Republished Package',
            'update'     => 'Edit  Republished Package',
            'index'    => 'Republished packages',
        ],

    ],
    'addations'  => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'options'       => 'Options',
            'status'        => 'Status',
            "name"          => " Name",
            "description"   => "Description",
            "price"         => "Price",
            "icon"          => "Icon",
        ],
        'form'      => [
            'status'        => 'Status',
            "name"          => " Name",
            "description"   => "Description",
            "price"         => "Price",
            "icon"          => "Icon",
            "type"          => "Type",
            "days"          => "number of days",
            'tabs'              => [
                'general'   => 'General Info.',
            ],
            "types" => [

                "normal" => "normal",
                "story" => "story",
            ]
        ],
        'routes'    => [
            'create'    => 'Create Ads Addition',
            'index'     => 'Ads Additions',
            'update'    => 'Update Ads Addition',
        ],

    ],
    'ad_types'  => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'options'       => 'Options',
            'status'        => 'Status',
            "name"          => " Name",
            "description"   => "Description",
            "icon"          => "Icon",

        ],
        'form'      => [

            'status'        => 'Status',
            "name"          => " Name",
            "description"   => "Description",
            "price"         => "Price",
            "icon"          => "Icon",
            "type"          => "Type",
            'tabs'              => [
                'general'   => 'General Info.',
            ],
        ],
        'routes'    => [
            'create'    => 'Create Ad Type',
            'index'     => 'Ads Ad Types',
            'update'    => 'Update Ad Type',
        ],

    ],
    'ads'  => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'options'       => 'Options',
            'status'        => 'Status',
            "title"          => "Title",
            "description"   => "Description",
            "total"         => "Total",
            "image"          => "Image",
            "start_at"       => "Start at",
            "user_type"     => "User Type",
            "end_at"       => "End at",
            "mobile"         => "Mobile ",
            "hide_private_number" => "Hide private number",
            "duration"        => "Duration",
            "is_paid"         => "Is Paid",
            "type"         => "Type",
            "price"         => "Ads Price ",
            "addation_total"   => "Addation total",
            "is_publish"       => "Is publish",
            "ads_price"        => "Ads Price",
            "subscription_id"  => "Subscription",
            "user_id"         => "User",
            "office_id"         => "Office",
            "category_id"         => "Category ",
            "country_id"         => "Country",
            "city_id"         => "City",
            "state_id"         => "State",
            "addations"        => "Addations",
            "address"           => "Address",
            "status_enum"       => [
                "wait"      => "Wait ",
                "confirm"   => "Confirm and Paid",
                "publish"   => "Publised",
                "expired"   => "Ecpired"
            ],
            "complaints" => [
                "name"  => "Name",
                "message" => "Message",

            ]


        ],
        'form'      => [

            'sort'        => 'Sort',
            'status'        => 'Status',
            "title"          => "Title",
            "description"   => "Description",
            "total"         => "Total",
            "image"          => "Image",
            "start_at"       => "Start at",
            "end_at"       => "End at",
            "mobile"         => "Mobile ",
            "attachs"          => "Attachs",
            "user_type"     => "User Type",
            "hide_private_number" => "Hide private number",
            "duration"        => "Duration",
            "is_paid"         => "Is Paid",
            "type"         => "Type",
            "price"         => "Ads Price ",
            "addation_total"   => "Addation total",
            "is_publish"       => "Is publish",
            "ads_price"        => "Ads Price",
            "ad_types"          => "Ad Types",


            "user_id"         => "User",
            "office_id"         => "Office",
            "category_id"         => "Category ",
            "country_id"         => "Country",
            "city_id"         => "City",
            "state_id"         => "State",
            "addations"        => "Addations",
            "address"           => "Address",
            "subscription_id"  => "Subscription",

            'tabs'              => [
                'general'   => 'General Info.',
                "attachs"    => "attachs",
                "payment"     => "payment",
                "adsOrder"     => "Addation Order",
                "user"         => "User",
                "categories"     => "Category",
                "attrbiutes"    => "Atributes",
                "complaints"    => "Complaints",
                "address"       => "Addresses",
            ],
            "take_from_subscription" => "Take from subscription Or from free",


        ],
        'routes'    => [
            'create'    => 'Create Ads',
            'index'     => 'Ads',
            'update'    => 'Update Ads',
            "show"      => "Edit Ads",
            'addations' => [
                'create'    => 'Create Ads Addations',
                'update'    => 'Update Ads Addations',
            ]
        ],

    ],
    'payments'  => [
        'datatable' => [
            'created_at'    => 'created at',
            'date_range'    => 'date range',
            'status'        => 'status',
            "type"         => "type",
            "ads"          => " ads",
            "total"         => "total",
            "user"         => "user",
        ],
        'status' => [
            'paied' => 'paid',
            'wait' => 'wait',
        ],
        'routes'    => [
            'index'     => 'payments',
        ],
    ],
    'coins_transactions'  => [
        'datatable' => [
            'created_at'    => 'created at',
            'date_range'    => 'date range',
            'status'        => 'status',
            'user'        => 'User',
            'balance_before'        => 'Balance before',
            'coins_number'        => 'Coins number',
            'balance_after'        => 'Balance after',
            'details'        => 'Details',
        ],
        'routes'    => [
            'index'     => 'User coins transactions',
        ],
    ],
    'coins' => [
        'datatable' => [
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'status' => 'Status',
            'title' => 'Title',
            'tier' => 'Apple Tier',
            'coins_number' => 'Coins Number',
        ],
        'form' => [
            'tabs' => [
                'general' => 'General Info.',
            ],
            'title' => 'Title',
            'description' => 'description',
            'status' => 'Status',
            'sort' => 'Sort',
            'tier' => 'Apple Tier',
            'coins_number' => 'Coins Number',
        ],
        'routes' => [
            'create' => 'Create Coin',
            'index' => 'Coins',
            'update' => 'Update Coin',
        ],
    ],
];
