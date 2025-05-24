<?php

return [
    'coupons'  => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            "code"         => "الكود",
            'min'              => 'اقل قيمه ',
            'max'               => ' اقصى قيمه فى حالة النسه ',
            "amount"            => "الخصم",
            "expired_at"        => "تاريخ الانتهاء",
            "max_use"           => "اقصى عدد مرات لاستخدام",
            "current_use"       => "عدد مرات الاستخدام",
            "max_use_user"      => " اقصى مرات استخدام للشخص ",
            "is_fixed"          => " قيمة ثابته",


        ],
        'form'      => [
            'status'        => 'الحالة',
            "code"         => "الكود",
            'min'              => 'اقل قيمه ',
            'max'               => ' اقصى قيمه فى حالة النسه ',
            "amount"            => "الخصم",
            "expired_at"        => "تاريخ الانتهاء",
            "max_use"           => "اقصى عدد مرات لاستخدام",
            "current_use"       => "عدد مرات الاستخدام",
            "max_use_user"      => " اقصى مرات استخدام للشخص ",
            "is_fixed"          => " قيمة ثابته",
            "packages"          => " الباقات ",
            'tabs'              => [
                'general'   => 'بيانات عامة',
            ],

        ],
        'routes'    => [
            'create'    => 'اضافة كوبون ',
            'index'     => ' الكوبونات ',
            'update'    => 'تعديل كوبون',
        ],
        'validation' => [
            "not_valid" => "الكوبون غير صالح "
        ],
    ],
    'packages'  => [
        'datatable' => [
            'created_at'     => 'تاريخ الآنشاء',
            'date_range'     => 'البحث بالتواريخ',
            'options'        => 'الخيارات',
            'status'         => 'الحالة',
            "is_free"        => "مجانيه",
            "title"          => "العنوان",
            "description"    => "الوصف",
            "price"          => "السعر (بالعملات)",
            "duration"       => "المده",
            "number_of_ads"   => "عدد الاعلانات",
            "number_of_image" => "عدد الصور",
            "duration_of_ads"  => "مدة الاعلان",

        ],
        'form'      => [

            'status'        => 'الحالة',
            "is_free"       => "مجانيه",
            "title"       => "العنوان",
            "description" => "الوصف",
            "price"     => "السعر (بالعملات)",
            "first_time" => "اول مره",
            "type"       => "نوع الباقه",
            "types"      => [
                "user"      => "مستختدم",
                "company"   => "شركه",
                "technical" => "فنى",
            ],
            "duration"  => "المده",
            "number_of_ads" => "عدد الاعلانات",
            "sort"          => "ترتيب الظهور",
            "number_of_image" => "عدد الصور",
            "duration_of_ads"  => "مدة الاعلان",
            'tabs'              => [
                'general'   => 'بيانات عامة',
            ],

        ],
        'routes'    => [
            'create'    => 'اضافة باقة  ',
            'index'     => ' باقات  ',
            'update'    => 'تعديل  باقة ',
        ],

    ],
    'republished_packages'  => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            "is_free"       => "مجانيه",
            "title"       => "العنوان",
            "description" => "الوصف",
            "price"     => "السعر (بالعملات)",
            "duration"  => "المده",

        ],
        'form'      => [

            'status'        => 'الحالة',
            "is_free"       => "مجانيه",
            "title"       => "العنوان",
            "description" => "الوصف",
            "price"     => "السعر (بالعملات)",
            "duration"  => "المده",
            'tabs'              => [
                'general'   => 'بيانات عامة',
            ],

        ],
        'routes'    => [
            'create'    => 'اضافة باقة لاعادة النشر ',
            'index'     => ' باقات لاعادة النشر ',
            'update'    => 'تعديل  باقة النشر',
        ],

    ],
    'addations'  => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            "name"          => " الاسم",
            "description"   => "الوصف",
            "price"         => "السعر (بالعملات)",
            "icon"          => "الايقونه",
        ],
        'form'      => [
            'status'        => 'الحالة',
            "name"          => " الاسم",
            "description"   => "الوصف",
            "price"         => "السعر (بالعملات)",
            "icon"          => "الايقونه",
            "type"          => "النوع",
            "days"          => "عدد الايام",
            'tabs'              => [
                'general'   => 'بيانات عامة',
            ],
            "types" => [
                "normal" => "عادي",
                "story" => "قصه",
            ]

        ],
        'routes'    => [
            'create'    => 'اضافة اصافة اعلان ',
            'index'     => '  اضافات الاعلانات ',
            'update'    => 'تعديل اضافة اعلان',
            'addations' => [
                'create'    => 'اضافه اضافه اعلان',
                'update'    => 'تعديل اضافات الاعلان',
            ]
        ],

    ],
    'ad_types'  => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            "name"          => " الاسم",
            "description"   => "الوصف",

            "icon"          => "الايقونه",


        ],
        'form'      => [

            'status'        => 'الحالة',
            "name"          => " الاسم",
            "description"   => "الوصف",
            "price"         => "السعر (بالعملات)",
            "icon"          => "الايقونه",
            "type"          => "النوع",
            'tabs'              => [
                'general'   => 'بيانات عامة',
            ],


        ],
        'routes'    => [
            'create'    => 'اضافة نوع اعلان ',
            'index'     => '  انواه الاعلانات ',
            'update'    => 'تعديل نوع اعلان',
        ],

    ],
    'ads'  => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'sort'        => 'ترتيب الظهور',
            "title"          => "عنوان",
            "description"   => "الوصف",
            "total"         => "اجمالى السعر (بالعملات)",
            "user_type"     => "نوع العضو",
            "image"          => "الصوره",
            "start_at"       => "يبدء في",
            "end_at"       => "ينتهى في",
            "mobile"         => "رقم الجوال ",
            "hide_private_number" => "اخفاء الرقم الخاص",
            "duration"        => "المده",
            "is_paid"         => "تم الدفع",
            "type"         => "نوع الاعلان",
            "price"         => "سعر الاعلان",
            "addation_total"   => "اجمالى الاضافة",
            "is_publish"       => "متاح للمشاهده",
            "ads_price"        => "سعر الخاص بالاعلان",
            "subscription_id"  => "الاشتراك",
            "user_id"         => "العضو",
            "office_id"         => "المكتب",
            "category_id"         => "نوع الاعلان",
            "user_type"     => "نوع العضو",
            "country_id"         => "البلد",
            "city_id"         => "المدينه",
            "state_id"         => "المنطقه",
            "addations"        => "الاضافات",
            "address"           => "العناوين",
            "status_enum"       => [
                "wait"      => "الانتظار ",
                "confirm"   => "تم التاكيد والدقع",
                "publish"   => "منشور",
                "expired"   => "تم الانتهاء"
            ],
            "complaints" => [
                "name"  => "الاسم",
                "message" => "البلاغ",

            ]


        ],
        'form'      => [

            'sort'        => 'ترتيب الظهور',
            'status'        => 'الحالة',
            "title"          => "عنوان",
            "description"   => "الوصف",
            "total"         => "اجمالى السعر (بالعملات)",
            "image"          => "الصوره الاساسيه",
            "attachs"          => "المرفقات",
            "start_at"       => "يبدء في",
            "end_at"       => "ينتهى في",
            "mobile"         => "رقم الجوال ",
            "hide_private_number" => "اخفاء الرقم الخاص",
            "duration"        => "المده",
            "is_paid"         => "تم الدفع",
            "type"         => "نوع الاعلان",
            "ad_types"          => "انواع الاعلان",
            "price"         => "سعر الاعلان",
            "addation_total"   => "اجمالى الاضافة",
            "ads_price"        => "سعر الخاص بالاعلان",
            "subscription_id"  => "الاشتراك",
            "user_id"         => "العضو",
            "office_id"         => "المكتب",
            "category_id"         => "نوع الاعلان",
            "country_id"         => "البلد",
            "city_id"         => "المدينه",
            "state_id"         => "المنطقه",
            'browse_image'     => 'استعراض الصوره',
            'btn_add_more'     => 'ضافه المزيد',
            'tabs'              => [
                'general'   => 'بيانات عامة',
                "attachs"    => "المرفقات",
                "payment"     => "عملية الدفع",
                "adsOrder"     => "الاضافات المضافه",
                "user"         => "العضو",
                "categories"     => "نوع الخدمه",
                "attrbiutes"    => "الصفات",
                "complaints"    => "البلاغات",
                "address"       => "العناوين",
                "gallery"       => "الصور",
            ],
            "addations" => "الاضافات",
            "take_from_subscription" => "خصم من المجانى او الاشتراك",
            'at_least_one_field' => 'مطلوب حقل واحد على الأقل',
            'confirm_msg' => 'هل انت متأكد ؟',


        ],
        'routes'    => [
            'create'    => 'اضافة  اعلان ',
            'index'     => 'الاعلانات ',
            'update'    => 'تعديل  اعلان',
            "show"      => "تفاصيل الاعلان",
        ],

    ],
    'payments'  => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'status'        => 'الحالة',
            "type"         => "نوع الاعلان",
            "price"         => "سعر الاعلان",
            "ads"          => " الاعلان",
            "total"         => "الاجمالي",
            "user"         => "العضو",
        ],
        'status' => [
            'paied' => 'مدفوع',
            'wait' => 'في الانتظار',
        ],

        'routes'    => [
            'index'     => 'المدفوعات ',

        ],

    ],
    'coins' => [
        'datatable' => [
            'created_at' => 'تاريخ الآنشاء',
            'updated_at' => 'تاريخ التحديث',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'title' => 'العنوان',
            'description' => 'الوصف',
            'tier' => 'Apple Tier',
            'coins_number' => 'عدد العملات',
        ],
        'form' => [
            'tabs' => [
                'general' => 'بيانات عامة',
            ],
            'title' => 'عنوان',
            'description' => 'الوصف',
            'sort' => 'ترتيب الظهور',
            'tier' => 'Apple Tier',
            'status' => 'الحالة',
            'coins_number' => 'عدد العملات',
        ],
        'routes' => [
            'create' => 'اضافة ',
            'index' => 'العملات',
            'update' => 'تعديل',
        ],
    ],
    'coins_transactions' => [
        'datatable' => [
            'created_at' => 'تاريخ الآنشاء',
            'updated_at' => 'تاريخ التحديث',
            'user' => 'العميل',
            'balance_before' => 'الرصيد قبل العمليه',
            'coins_number' => ' قيمة العمليه',
            'balance_after' => 'الرصيد بعد العمليه',
            'details' => 'التفاصيل',
            'date_range' => 'البحث بالتواريخ',
        ],
        'routes' => [
            'create' => 'اضافة ',
            'index' => 'عمليات شحن وصرف العملات',
            'update' => 'تعديل',
        ],
    ],
];
