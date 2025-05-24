<?php

return [
    /*
            |--------------------------------------------------------------------------
            | Validation Language Lines
            |--------------------------------------------------------------------------
            |
            | The following language lines contain the default error messages used by
            | the validator class. Some of these rules have multiple versions such
            | such as the size rules. Feel free to tweak each of these messages.
            |
    */

    'accepted' => 'يجب قبول :attribute',
    'active_url' => ':attribute لا يُمثّل رابطًا صحيحًا',
    'after' => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي :attribute سوى على حروف',
    'alpha_dash' => ' يجب أن يكون :attribute باللغة الانجليزية وأرقام فقط',


    'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array' => 'يجب أن يكون :attribute ًمصفوفة',
    'before' => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
    'between' => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
    ],
    'boolean' => 'يجب أن تكون قيمة :attribute إما true أو false ',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'date' => ':attribute ليس تاريخًا صحيحًا',
    'date_format' => 'لا يتوافق :attribute مع الشكل :format.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits' => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام',
    'digits_between' => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام ',
    'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'exists' => ':attribute غير مسجل لدينا',
    'file' => 'الـ :attribute يجب أن يكون ملفا.',
    'filled' => ':attribute إجباري',
    'image' => 'يجب أن يكون :attribute صورةً',
    'in' => ' (:values) غير موجود ف الاختيارات ',
    'in_array' => ':attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون :attribute عددًا صحيحًا',
    'ip' => 'يجب أن يكون :attribute عنوان IP صحيحًا',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json' => 'يجب أن يكون :attribute نصآ من نوع JSON.',
    'max' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر لـ :max.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'string' => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'min' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر لـ :min.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'string' => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر',
    ],
    'not_in' => ':attribute لاغٍ',
    'numeric' => 'يجب على :attribute أن يكون رقمًا',
    'present' => 'يجب تقديم :attribute',
    'regex' => 'صيغة :attribute غير صحيحة',
    'required' => ':attribute مطلوب ',
    'required_if' => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless' => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with' => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all' => ':attribute مطلوب إذا توفّر :values.',
    'required_without' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق :attribute مع :other',
    'size' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'string' => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
        'array' => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالظبط',
    ],
    'string' => 'يجب أن يكون :attribute نصآ.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique' => 'قيمة :attribute مُستخدمة من قبل',
    'uploaded' => 'فشل في تحميل الـ :attribute',
    'url' => 'صيغة الرابط :attribute غير صحيحة',

    /*
            |--------------------------------------------------------------------------
            | Custom Validation Language Lines
            |--------------------------------------------------------------------------
            |
            | Here you may specify custom validation messages for attributes using the
            | convention "attribute.rule" to name the lines. This makes it quick to
            | specify a specific custom language line for a given attribute rule.
            |
    */

    'custom' => [
        "question.ar" => [
            "required" => "السؤال باللغه العربيه",
        ],
        "question.en" => [
            "required" => "السؤال باللغه الانجليزيه",
        ],
        "answer.en" => [
            "required" => "الاجابه باللغه الانجليزيه",
        ],
        "answer.ar" => [
            "required" => "الاجابه باللغه العربيه",
        ],
        'socials.*.type' => [
            'exists' => 'نوع تواصل الاجتماعى غير مسجل لدينا',

        ],
        'socials.*.link' => [
            'url' => ' صيغة الرابط غير صحيحه',
        ],
        "hashtag.*" => [
            "required" => "قيم الهاشتاجات مطلوبه"
        ],
        "mentions.*" => [
            "required" => "قيم المزكور مطلوبه"
        ],
        "mentions.*" => [
            "required" => "قيم المزكور مطلوبه"
        ],
        "title.ar" => [
            "required" => " العنوان باللغه العربيه مطلوب",
            "max"       => "العنوان باللغه العربيه يجب ان يكون بحد اقصى 255"
        ],
        "description.ar" => [
            "required" => " الوصف باللغه العربيه مطلوب",
        ],
        "description.en" => [
            "required" => " الوصف باللغه الانجليزيه مطلوب",
        ],
        "title.en" => [
            "required" => " العنوان باللغه الانجليزيه مطلوب",
            "max"       => "العنوان باللغه الانجليزيه يجب ان يكون بحد اقصى 255"
        ],
        "tags.*" => [
            "required" => "قيم العلامات مطلوبه"
        ],
        "socials.*.key" => [
            'exists' => 'نوع تواصل الاجتماعى غير مسجل لدينا',
        ],
        "socials.*.link" => [
            'required' => 'الرابط مطلوب ',
        ],
        "socials.*.social_id" => [
            'exists' => 'وسيلة تواصل الاجتماعى غير مسجل لدينا',
            "required" => "وسيلة التواصل مطلوبه"
        ],
        "socials.*.social_option_id" => [
            'exists' => 'خيارات وسيلة  تواصل الاجتماعى غير مسجل لدينا ',
            "required" => "خيارات وسيلة  التواصل مطلوبه "
        ],
        "bank.user_name" => [
            "required" => "اسم صاحب الحسا ب مطلوب",
            "max"       => "اقصى عدد للحروف 255 ",

        ],
        "bank.account_number" => [
            "required" => "رقم الحساب مطلوب ",
            "max"       => "اقصى عدد للحروف 255 ",
            "numeric" => "يجب ان يكون ارقام"
        ],
        "bank.address" => [
            "required" => "العنوان لصاحب الحساب مطلوب",
            "max"       => "اقصى عدد للحروف 255 ",
            "numeric" => ""
        ],
        "bank.iban" => [
            "required" => "رقم الابيان مطلوب",
            "max"       => "اقصى عدد للحروف 255 ",
            "numeric" => "يجب ان يكون ارقام"
        ],
        "bank.bank_name" => [
            "required" => "اسم البنك مطلوب ",
            "max"       => "اقصى عدد للحروف 255 ",
            "numeric" => ""
        ],
    ],

    /*
            |--------------------------------------------------------------------------
            | Custom Validation Attributes
            |--------------------------------------------------------------------------
            |
            | The following language lines are used to swap attribute place-holders
            | with something more reader friendly such as E-Mail Address instead
            | of "email". This simply helps us make messages a little cleaner.
            |
    */

    'attributes' => [
        "balance"  => "الرصيد",
        'name' => 'الاسم',

        'name.*' => 'الاسم بالغات المتاحه',
        "validation.min"    => "اقل قيمه",
        "validation.validate_max"    => " تفعيل اقصى قيمه",
        "validation.validate_min"    => " تفعيل اقل قيمه",
        "validation.max"    => "اقصى قيمه ",

        'message' => 'محتوى الرسالة',
        'username' => 'اسم المُستخدم',
        'email' => 'البريد الالكتروني',
        'first_name' => 'الاسم',
        'last_name' => 'اسم العائلة',
        'password' => 'كلمة المرور',
        'current_password' => 'كلمة المرور الحالية ',
        'new_password' => 'كلمة المرور الجديدة',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city' => 'المدينة',
        'country' => 'الدولة',
        'address' => 'العنوان',
        'phone' => 'الهاتف',
        'mobile' => 'الجوال',
        'age' => 'العمر',
        'sex' => 'الجنس',
        'gender' => 'الجنس',
        "flag"    => "علم",
        'day' => 'اليوم',
        'month' => 'الشهر',
        'year' => 'السنة',
        'hour' => 'ساعة',
        "sections" => "المراحل التعليميه",
        "subjects" => "المواد التعليميه",
        "online_price"    => "سعر الحصه الاونلاين",
        "house_price"   => "سعر الحصه فى المنزل",
        "lesson_type"   => "نوع الحصه",
        "offs.start" => "بداية العطله",
        "offs.end" => "نهاية العطله ",
        "have_off"    => "تفعيل العطله",
        'minute' => 'دقيقة',
        'second' => 'ثانية',
        'title' => 'الاسم',
        'content' => 'المُحتوى',
        'description' => 'الوصف',
        "teacher_id"  => "المعلم",
        "student_id" => "الطالب",
        "options"   => "الاختيارات",
        'excerpt' => 'المُلخص',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'available' => 'مُتاح',
        'size' => 'الحجم',
        'payment_type' => 'طرق الدفع',
        'category_description' => 'وصف القسم',
        'category_name' => 'اسم القسم',
        'category_icon' => 'الايكونه',
        'image' => 'الصوره',

        'new_category_description' => 'وصف القسم',
        'new_category_name' => 'اسم القسم',
        'new_category_icon' => 'الايكونه',
        'image' => 'صورة ',
        'new_category_image' => 'صورة القسم',
        'about_tribe' => 'عن القبيله',
        'about_supervisor' => 'سيرته الذاتيه',
        'supervisor_achievements' => 'انجازاته',
        'aqsan_history' => 'تاريخ القبيله',
        'aqsan_pens' => 'اقلام القبيله',
        'about' => 'نبذه عن المدير ',
        'photo' => 'الصوره',
        'edit_name' => 'الاسم',
        'edit_phone' => 'الهاتف',
        'edit_about' => 'نبذه عن المدير',
        'edit_photo' => 'الصوره',

        'poem_writer' => 'اسم الشاعر',
        'poem_name' => 'اسم القصيده',
        'counter' => 'عدد الابيات',

        'edit_poem_writer' => 'اسم الشاعر',
        'edit_poem_name' => 'اسم القصيده',
        'edit_counter' => 'عدد الابيات',
        'edit_content' => 'المقالات',
        "discount"        => "الخصم",
        'edit_shelat_writer' => 'اسم الشاعر',
        'edit_shelat_name' => 'اسم الشيله',

        'shelat_writer' => 'اسم الشاعر',
        'shelat_name' => 'اسم الشيله',

        'symbole_name' => 'اسم الرمز',

        'intro_image' => 'صورة المقدمه',
        "link"       => "الرابط",
        'site_name'  => 'اسم الموقع',
        'site_link'  => 'لينك الموقع',
        'edit_site_name'  => 'اسم الموقع',
        'edit_site_link'  => 'لينك الموقع',
        'add_logo' => 'لوجو الموقع',
        'edit_logo' => 'لوجو الموقع',

        'sms_message' => 'نص الرساله',
        'email_message' => 'نص الرساله',

        'avatar' => 'الصوره',
        'end_date' => 'تاريخ الانتهاء',
        'start_date' => 'تاريخ البداية',
        'project_id' => 'اسم المشروع',
        'category_id' => 'القسم',
        'service_id' => 'القسم الفرعي',
        'lat'        => ' الموقع علي الخريطة ',
        'long'        => ' الموقع علي الخريطة',
        "c_attributes"   => "الصفات",
        "c_attributes.*" => "احدى الصفات",
        'provider_name' => ' اسم المورد ',
        'product_name' => ' اسم المنتج ',
        'product_quantity' => ' الكمية ',
        'product_price' => ' المبلغ الاجمالي ',
        'paid' => ' المبلغ المدفوع ',
        "title.*"  => "العنوان بالللغات المتاحه",
        "description.*"  => "الوصف بالللغات المتاحه",
        'stay' => ' المبلغ المدين ',
        'add_provider_name' => ' اسم المورد ',
        'add_product_name' => ' اسم المنتج ',
        'add_product_quantity' => ' الكمية ',
        'add_product_price' => ' المبلغ الاجمالي ',
        'add_paid' => ' المبلغ المدفوع ',
        'add_stay' => ' المبلغ المدين ',
        'subject'  => ' موضوع الرسالة ',
        'rating'   => 'التقييم',
        "name.*"  => "الاسم باللغات المتاحه",
        'code'     => ' كود ',
        'edit_code'     => ' كود ',
        'role'     => 'الصلاحيه',

        'edit_role'     => 'الصلاحيه',
        'type'     => 'النوع',
        'edit_type'     => 'النوع',
        'end_at'   => 'تاريخ الانتهاء',
        'edit_end_at' => 'تاريخ الانتهاء',
        'today'    => 'اليوم',
        'value'    => 'القيمة',
        'edit_value'    => 'القيمة',
        'num_to_use' => 'عدد مرات الاستخدام',
        'edit_num_to_use' => 'عدد مرات الاستخدام',
        'receive_address'      => 'عنوان الاستلام',
        'edit_receive_address' => 'عنوان الاستلام',
        'deliver_address'      => 'عنوان التسليم',
        'edit_deliver_address' => 'عنوان التسليم',
        'edit_description'     => 'تفاصيل الدفع',
        'reason_ar'            => 'السبب بالعربية',
        "equipment"               => "معدات",
        'reason_en'            => 'السبب بالانجليزية',
        'edit_reason_ar'       => 'السبب بالعربية',
        'edit_reason_en'       => 'السبب بالانجليزية',
        'price'                => 'السعر (بالعملات)',
        'edit_price'           => 'السعر (بالعملات)',
        'deleteids'            => 'تحديد عناصر للحذف',
        'device_id'            => 'تسجيل الخروج',
        'coupon'               => 'رقم الكوبون',
        'store_id'             => 'المتجر',
        'family_id'            => 'الأسرة',
        'identity_num'         => 'رقم الهوية',
        'identity_image'       => 'صورة بطاقة الهوية',
        'medicine_name'        => 'اسم الدواء',
        'medicine_foucs'       => 'تركيز الدواء',
        'medicine_cost'        => 'تكلفة الدواء',
        'rochta_image'         => 'صورة الوصفة الطبية',
        'device_name'          => 'اسم الجهاز',
        'device_description'   => 'وصف الجهاز',
        'device_image'         => 'صورة الجهاز',
        'device_status'        => 'حالة الجهاز',
        'reason'               => 'السبب',
        "classe_id"               => "الحصه",
        "group_id"               => "المجموعه",
        'identity_card'        => 'رقم الهوية الوطنية / هوية مقيم',
        "phone_code"           => "كود البلد",
        "code_verified"        => "كود التاكيد المرسل",
        "lang"                   => "اللغه",
        "section_id"           => "الرياضه",
        "vendor_id"               => "المؤسسه",
        "price_before"           => "السعر (بالعملات) قبل",
        "price_after"           => "السعر (بالعملات) بعد",
        "start_at"               => "تاريح بداية ",
        "subject_id"           => "الماده",
        "end_at"               => "تاريح النهايه ",
        "day_number"           => "عدد الايام",
        "medicine_name"        => "اسم الدواء",
        "solution.note"           => "ملاحظة الحل",
        "solution.attachs"       => "مرفقات الحل",
        "pateient_name"           => "اسم المريض",
        "note"                   => "الملاحظه",
        "socials"               => "وسائل التواصل",
        "categories"           => " الاقسام  ",
        "contact_person"       => "وسبلة اتصال شخصيه",
        "details"               => "التفاصيل",
        "publish_at"           => "موعد النشر",
        "followers"               => "المتابعين",
        "hashtag"               => "الهاشتاج",
        "mentions"               => "المذكور",
        "tags"                   => "العلامات",
        "from"                   => "من",
        "duration_of_ads"       => "مدة الاعلان",
        "to"                   => "الى",
        "influencer_request_id" => "عرض المشهور",
        "business_request_id"  => "طلب الشركه",
        "icon"                   => "الايقونه",
        "options"               => "الاختيارات",
        "key"                   => "الاسم المعروف",
        "amount"               => "المبلغ",
        "user_name"               => "اسم المستخدم",
        "images"               => "الصور",
        "current_password"     => "كلمة السر الحاليه",
        "password_confirmation" => "تاكيد كلمة السر ",
        "new_password"           => "كلمة السر الجديده",
        "country_id"            => "البلد",
        "city_id"            => "المدينه",
        "state_id"            => "المنطقه",
        "number"        => "العدد ",
        "contact_phone"    => "رقم التواصل",
        "cover"    => "الصوره الرئيسيه	",
        "rate"          => "التقيم",
        "lng"            => "الموقع على الخريطه",
        "duration"        => "المده",
        "money"            => "المبلغ",
        "number_of_ads"    => "عدد الاعلانات",
        "sale"       => "سعر البيع",
        "buy"       => "سعر الشراء ",
        "type"            => "النوع",
        "sender"        => "بيانات المرسل",
        "reciever"        => "بيانات المستلم",
        "sender.name"                => "اسم المرسل",
        "sender.mobile"                => "رقم جوال المرسل",
        "sender.national_card"        => "رقم هوية المرسل",
        "sender.address"            => "عنوان المرسل",
        "sender.card_image"            => "صورة هوية المرسل",

        "reciever.name"                => "اسم المستلم",
        "reciever.mobile"            => "رقم جوال المستلم",
        "reciever.national_card"    => "رقم هوية المستلم",
        "reciever.address"            => "عنوان المستلم",
        "reciever.card_image"        => "صورة هوية المستلم",
        "exchange_rate"                => "سعر الصرف",
        "hide_private_number"        => "اخفاء الرقم",
        "phone_number"                => "رقم الهاتف",
        "phone_whatsapp"                => "رقم الوتساب",
        "type"                        => "النوع",


        "office"                    => "بيانات المكتب",
        "office.title"                => "عنوان المكتب",
        "office.description"        => "وصف المكتب",
        "office.mobile"        => "رقم الجوال المكتب",
        "office.image"        => "صورة  المكتب",
        "office.country_id"    => "بلد  عنوان المكتب",
        "office.package_id"    => "الباقة الحاليه للمكتب",
        "office.city_id"    => " مدينة عنوان المكتب ",
        "office.state_id"    => " منطقة عنوان المكتب ",
        "use_pakcage_info"  => "استخدام بيانات الباقه ",
        "subscription.current_use" => "عدد مرات الاستختدام الحاليه",
        "subscription.max_use" => "اقصى مرات  لاستختدام الاشتراك",
        "subscription.end_at"  => "تاريخ نهاية الاشتراك",
        "subscription.start_at"  => "تاريخ بداية الاشتراك",
        "subscription.money"  => "تكلفة الاشتراك",
        "subscription.duration_of_ads"    => "مدة عرض الاعلان فى الاشتراك",
        "adsAttributes.*.attribute_id" => "الصفه",
        "adsAttributes.*.optional_id"  => "الاختيار",
        "adsAttributes.*.value"           => "القيمه",
        "agree_policy"   => "الموافقة على الشروط والاحكام",

        "ads_id"        => "الاعلان",
        "addations.*"    => "الاضافات",
        "package_id"    => "الباقه",
        "address.*.city_id" => " المدينه فى العنوان ",
        "address.*.state_id" => "المنطقة فى العنوان ",
        "address.*.country_id" => "البلد فى العنوان ",
        "socials.*.key" => "وسلة التواصل ",
        "ad_types"        => "انواع الاعلان",
        "ad_types.*"        => "احدى انواع الاعلانات",
        "allow_from_to"    => "اتاحة  نطاق",

    ],
];
