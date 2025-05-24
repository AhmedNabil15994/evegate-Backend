<?php

return [
    'attributes'  => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'options'       => 'Options',
            'status'        => 'Status',
            "type"         => "Type" ,
            'name'         => 'Name',
          
            "icom"      => "Icon" ,
            "order"     => "Orders",
            "options"     => "Options",
            "values"     => "Values",
            "show_in_search" => "Show in search",

        ],
        'form'      => [
            'name'         => 'name',
            'options'       => 'Options',
            'status'        => 'Status',
            'name'         => 'Name',
            "type"         => "Type" ,
            "allow_from_to"    => "Allow Range",

            "show_in_search" => "Show in search",
          
            "icom"      => "Icon" ,
            "order"     => "Orders",
            "options"     => "Options",
            "values"     => "Values",
            'tabs'              => [
                'general'   => 'General Info.',
                "validation" => "Validation"
    
            ],
        ],
        'routes'    => [
            'create'    => 'Create Attribute',
            'index'     => 'Attributes',
            'update'    => 'Update Attribute',
        ],
       
    ],
   
];
