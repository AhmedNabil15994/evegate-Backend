<?php

return [
    'advertisement'   => [
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
        ],
        'form'      => [
            'end_at'    => 'الانتهاء في',
            'image'     => 'الصورة',
            'link'      => 'رابط الدعائيه',
            'start_at'  => 'يبدا في',
            'status'    => 'الحاله',
            "type"      => "نوع الاعلان", 
            "out"      => "خارجى", 
            "ads_id" => "الاعلان",
            "in"      => "داخلى",
            "advertising_id"=> "الاعلان", 
            'tabs'      => [
                'general'   => 'بيانات عامة',
            ],
        ],
        'routes'    => [
            'create'    => 'اضافة صور دعائيه',
            'index'     => 'صور الدعائيه',
            'update'    => 'تعديل صورة دعائيه',
        ],
        'validation'=> [
            'end_at'    => [
                'required'  => 'من فضلك اختر تاريخ الانتهاء',
            ],
            'image'     => [
                'required'  => 'من فضلك اختر صورة الدعائيه',
            ],
            'link'      => [
                'required'  => 'من فضلك ادخل رابط الدعائيه',
            ],
            'start_at'  => [
                'required'  => 'من فضلك اختر تاريخ البدء',
            ],
        ],
    ],
];
