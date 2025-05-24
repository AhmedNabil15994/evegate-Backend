<?php

return [
    'categories'    => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'image'         => 'Image',
            'options'       => 'Options',
            'status'        => 'Status',
            'title'         => 'Title',
            "price"          => "Price",
            "attributes"        => "Attributes",
        ],
        'form'      => [
            'color'             => 'Color',
            'image'             => 'Image',
            'main_category'     => 'Main Category',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            "is_end_category"   => "End Level of category",
            "slim_details"      => "Slim Details",
            "price"             => "Price",
            "attributes"        => "Attributes",
            "type"              => "Type",
            'status'            => 'Status',
            "sort"              => "Sort",
            "type"              => "Type",
            "types"             => [
                "user"   => "user",
                "offer"    => "Offer",
                "company" => "Company",
                "technical"=> "Technical"
            ],
            'tabs'              => [
                'category_level'    => 'Services Tree',
                'general'           => 'General Info.',
                'seo'               => 'SEO',
            ],
            'title'             => 'Title',
        ],
        'routes'    => [
            'create'    => 'Create Service',
            'index'     => 'Services',
            'update'    => 'Update Category',
        ],
        'validation'=> [
            'category_id'   => [
                'required'  => 'Please select Service level',
            ],
            'image'         => [
                'required'  => 'Please select image',
            ],
            'title'         => [
                'required'  => 'Please enter the title',
                'unique'    => 'This title is taken before',
            ],
        ],
    ],
];
