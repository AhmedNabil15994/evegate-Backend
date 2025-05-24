<?php

return [
   
        'offers'  => [
            'datatable' => [
                'created_at'    => 'تاريخ الآنشاء',
                'date_range'    => 'البحث بالتواريخ',
                'options'       => 'الخيارات',
                'status'        => 'الحالة',
                "title"       => "العنوان" ,
                "description" => "الوصف",
                "percent"     =>"النسبه" ,
                "start_at"  =>"يبدء في" ,
                "end_at" => "ينتهى",
                "category_id" => "نوع الاعلان",
                "image"     => "الصوره",
                "phone_number"				=> "رقم الهاتف",
		        "phone_whatsapp"				=> "رقم الوتساب",
              
            ],
            'form'      => [
                
                'status'        => 'الحالة',
                "title"       => "العنوان" ,
                "description" => "الوصف",
                "percent"     =>"النسبه" ,
                "start_at"  =>"يبدء في" ,
                "end_at" => "ينتهى",
                "category_id" => "نوع الاعلان",
                "price_after"=> " السعر (بالعملات) بعد الخصم",
                "price_before"=> " السعر (بالعملات) قبل الخصم",
                "image"     => "الصوره",
                "phone_number"				=> "رقم الهاتف",
		        "phone_whatsapp"				=> "رقم الوتساب",
                'tabs'              => [
                    'general'   => 'بيانات عامة',
                    "categories"=> "النوع",
                ],
              
            ],
            'routes'    => [
                'create'    => 'اضافة  عرض ',
                'index'     => 'العروض',
                'update'    => 'تعديل عرض',
            ],
           
        ],
    
];
