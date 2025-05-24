<?php

return [
    'slider'   => [
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
            "slider_id" => "Slider",
            'link'      => 'Link',
            'start_at'  => 'Start at',
            'status'    => 'Status',
            "type"      => "Type",
            "position"              => "Display position",
            "positions"             => [
                "normal"   => "Ad",
                "offer"    => "Offer",
                "company" => "Company",
                "technical"=> "Technical"
            ],
            "add_id" => "Ads",
            "out"      => "Out",
            "in"      => "In",
            "advertising_id"=> "advertising",
            'tabs'      => [
                'general'   => 'General Info.',
                "categories"=>"Categories"

            ],
        ],
        'routes'    => [
            'create'    => 'Create slider images',
            'index'     => 'slider images',
            'update'    => 'Update slider images',
        ],
        'validation'=> [
            'end_at'    => [
                'required'  => 'Please select slider image ent at',
            ],
            'image'     => [
                'required'  => 'Please select image of the slider image',
            ],
            'link'      => [
                'required'  => 'Please add the link of slider image',
            ],
            'start_at'  => [
                'required'  => 'Please select the date of started slider image',
            ],
        ],
    ],
];
