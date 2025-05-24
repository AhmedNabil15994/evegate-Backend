<?php

return [
    'sections'  => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'options'       => 'Options',
            'status'        => 'Status',
            'title'         => 'Title',
        ],
        'form'      => [
            "icon"              => "Icon " ,
            'description'       => 'Description',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'Status',
            "have_period"       => "Have Period",
            "have_country"       => "Have Country",
            "subsection"        => "Sub Sction",
            "default_sub"       => "Main section",
            "image"             => "Image",     
            'tabs'              => [
                'general'   => 'General Info.',
                'seo'       => 'SEO',
            ],
            'title'             => 'Title',
        ],
        'routes'    => [
            'create'    => 'Create educational stage',
            'index'     => ' Educational stages ',
            'update'    => 'Update educational stage ',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'Please enter the description of section',
            ],
            'title'         => [
                'required'  => 'Please enter the title of section',
                'unique'    => 'This title section is taken before',
            ],
        ],
    ],
];
