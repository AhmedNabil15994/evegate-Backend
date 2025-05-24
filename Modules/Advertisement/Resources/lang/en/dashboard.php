<?php

return [
    'advertisement'   => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'end_at'        => 'End at',
            'image'         => 'Image',
            'link'          => 'Link',
            'options'       => 'Options',
            'start_at'      => 'Start at',
            'status'        => 'Status',
            "add_id" => "Ads",
        ],
        'form'      => [
            'end_at'    => 'End at',
            'image'     => 'Image',
            "advertisement_id" => "Ads",
            'link'      => 'Link',
            'start_at'  => 'Start at',
            'status'    => 'Status',
            "type"      => "Type",
            "add_id" => "Ads",
            "out"      => "Out",
            "in"      => "In",
            "advertising_id"=> "advertising",
            'tabs'      => [
                'general'   => 'General Info.',
            ],
        ],
        'routes'    => [
            'create'    => 'Create  Advertisements images',
            'index'     => 'Advertisements images',
            'update'    => 'Update Advertisements images',
        ],
        'validation'=> [
            'end_at'    => [
                'required'  => 'Please select advertisement image ent at',
            ],
            'image'     => [
                'required'  => 'Please select image of the advertisement image',
            ],
            'link'      => [
                'required'  => 'Please add the link of advertisement image',
            ],
            'start_at'  => [
                'required'  => 'Please select the date of started advertisement image',
            ],
        ],
    ],
];
