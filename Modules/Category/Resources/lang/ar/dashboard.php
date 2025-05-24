<?php

return [
    'categories'    => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'image'         => 'الصورة',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
            "type"              => "النوع",
            "price"             => "السعر (بالعملات)",
            "attributes"        => "الصفات المتاحه",
        ],
        'form'      => [
            'color'             => 'اللون',
            'image'             => 'الصورة',
            'main_category'     => 'قسم رئيسي',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'الحالة',
            "is_end_category"   => "اخر مستوى ",
            "slim_details"      => "تفاصيل مختصره",
            "attributes"        => "الصفات المتاحه",
            "price"             => "السعر (بالعملات)",
            "sort"              => "ترتيب الظهور",
            "type"              => "النوع",
            "types"             => [
                "user"   => "المستخدمين",
                "offer"    => "العروض",
                "company" => "الشركات",
                "technical"=> "الفنيين"
            ],
            'tabs'              => [
                'category_level'    => 'مستوى  الاقسام  ',
                'general'           => 'بيانات عامة',
                'seo'               => 'SEO',
            ],
            'title'             => 'عنوان',
        ],
        'routes'    => [
            'create'    => 'اضافة  الاقسام  ',
            'index'     => ' الاقسام  ',
            'update'    => 'تعديل   الاقسام ',
        ],
        'validation'=> [
            'category_id'   => [
                'required'  => 'من فضلك اختر مستوى البرند',
            ],
            'image'         => [
                'required'  => 'من فضلك اختر الصورة',
            ],
            'title'         => [
                'required'  => 'من فضلك ادخل العنوان',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
];
