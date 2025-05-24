<?php

return [
    'slider'   => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'end_at'        => 'الانتهاء في',
            'image'         => 'الصورة',
            'link'          => 'الرابط',
            'options'       => 'الخيارات',
            "ads_id" => "الاعلان",
            'start_at'      => 'يبدا في',
            'status'        => 'الحاله',
            "position"              => "مكان الظهور"
        ],
        'form'      => [
            'end_at'    => 'الانتهاء في',
            'image'     => 'الصورة',
            'link'      => 'رابط السلايدر',
            'start_at'  => 'يبدا في',
            'status'    => 'الحاله',
            "type"      => "نوع الاعلان", 
            "position"              => "مكان الظهور",
            "positions"             => [
                "normal"   => "الاعلانات",
                "offer"    => "العروض",
                "company" => "الشركات",
                "technical"=> "الفنيين"
            ],
            "out"      => "خارجى", 
            "ads_id" => "الاعلان",
            "in"      => "داخلى",
            "advertising_id"=> "الاعلان", 
            'tabs'      => [
                'general'   => 'بيانات عامة',
                "categories"=>"الاقسام"
            ],
        ],
        'routes'    => [
            'create'    => 'اضافة صور السلايدر',
            'index'     => 'صور السلايدر',
            'update'    => 'تعديل السلايدر',
        ],
        'validation'=> [
            'end_at'    => [
                'required'  => 'من فضلك اختر تاريخ الانتهاء',
            ],
            'image'     => [
                'required'  => 'من فضلك اختر صورة السلايدر',
            ],
            'link'      => [
                'required'  => 'من فضلك ادخل رابط السلايدر',
            ],
            'start_at'  => [
                'required'  => 'من فضلك اختر تاريخ البدء',
            ],
        ],
    ],
];
