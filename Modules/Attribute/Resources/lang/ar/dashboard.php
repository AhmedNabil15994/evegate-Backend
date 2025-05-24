<?php

return [
    'attributes'  => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            "type"         => "النوع" ,
            "name"          => "الاسم",
            "icon"              => "الايقونه" ,
            'title'         => 'العنوان',
            "options"       => "الاختيارات", 
            "value"         => "القيمه" , 
            "show_in_search" => "الاتاحه فى البحث",
            "order"         => "ترتيب",
           
        ],
        'form'      => [
            'name'       => 'الاسم',
            'status'        => 'الحالة',
            "allow_from_to"    => "اتاحة  نطاق",
            "name"          => "الاسم",
            "type"         => "النوع" ,
            "option_default"   => "القيمه الافتراضيه" ,
            "icon"              => "الايقونه" ,
            'title'         => 'العنوان',
            "options"       => "الاختيارات", 
            "value"         => "القيمه" , 
            "order"         => "ترتيب",
            "limit"         => "القيم المتاحه", 
            "show_in_search" => "الاتاحه فى البحث",
            "allow_limit"   => "تفعيل ",
            "validation"   => [
                "min" => "اقل قيمه",
                "max" => "اعلى قيمه",   
                "is_int" => "رقم صحيح",
                "validate_min" =>"تتطبيق اقل قيمه",
                "validate_max" =>"تتطبيق اقصى قيمه",
                "required"     => "مطلوب" 
            ]
            ,
            'tabs'              => [
                'general'   => 'بيانات عامة',
                "validation" => "Validation"
            ],
            "types"         => [
            
            ]
        ],
        'routes'    => [
            'create'    => 'اضافة صفه',
            'index'     => ' الصفات ',
            'update'    => 'تعديل صفه',
        ],
        
    ],
 
];
