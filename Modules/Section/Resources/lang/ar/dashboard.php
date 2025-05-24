<?php

return [
    'sections'  => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'form'      => [
            "icon"              => "شعار اللعبه" ,
            'description'       => 'الوصف',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'الحالة',
            "have_period"       => "يحتوى على مدة",
            "have_country"       => "يحتوى على بلد ",
            "subsection"        => "سكشن فرعى ",
            "default_sub"       => "سكشن اساسى",
            "image"             => "الصوره",        
            'tabs'              => [
                'general'   => 'بيانات عامة',
                'seo'       => 'SEO',
            ],
            'title'             => 'عنوان',
        ],
        'routes'    => [
            'create'    => 'اضافة  رياضه ',
            'index'     => 'المراحل التعليميه ',
            'update'    => 'تعديل الرياضه',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'من فضلك ادخل وصف القسم',
            ],
            'title'         => [
                'required'  => 'من فضلك ادخل عنوان القسم',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
];
