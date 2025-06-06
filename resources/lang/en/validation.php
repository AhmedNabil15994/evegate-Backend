<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain english letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

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
        'socials.*.type' => [
			'exists' => 'socials type in array not exist in ours',
		],
		'socials.*.link' => [
			'url' => 'Socials url not correct formate',
        ],
        "hashtag.*"=>[
			"required" => "hashtag is required"
		],
		"mentions.*"=>[
			"required" => "mentions  is required"
		],

		"tags.*"=>[
			"required" => "tags is required"
        ],
        "title.ar"=>[
			"required" => "Title Arabic is required"
		],
		"title.en"=>[
			"required" => "Title English is required"
		],
		"socials.*.link"=>[
			'required' => ' socials link required ',
		],
		"socials.*.social_id"=>[
			'exists' => ' social not found  ',
			"required" => "socials is required"
		],
		"socials.*.social_option_id"=>[
			'exists' => 'socials option not reigster our us ',
			"required" => "socials option is required "
        ],
        "bank.user_name"=>[
			"required" => "user name is required",
			 "max"	   => "user name max 255"		,
			 "numeric" =>""
		],
		"bank.account_number"=>[
			"required" => "account number is required ",
			 "max"	   => ""		,
			 "numeric" =>"account number must be numeric "
		],
		"bank.address"=>[
			"required" => "address is required",
			 "max"	   => "address max length 255"		,
			 "numeric" =>""
		],
		"bank.iban"=>[
			"required" => "iban is required",
             "max"	   => "address max length 255"		,
			 "numeric" =>"iban number must be numeric "
		],
		"bank.bank_name"=>[
			"required" => " bank name is required",
            "max"	   => "bank name max length 255"		,
			 "numeric" =>""
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
        'name' => 'name',
        'name.*' => 'Name in Available lanage ' ,
		"validation.min"	=>" validation min ",
		"validation.validate_max"	=>"validation validate max",
		"validation.validate_min"	=>"validation validate min",
		"validation.max"	=>" validation max ",

        'message' => 'message',
        'username' => 'username',
        'email' => 'email',
        'password' => 'password',
        'current_password' => 'current password ',
        'new_password' => 'new password',
        'password_confirmation' => 'password confirmation',
        'city' => 'city',
        'country' => 'country',
        'address' => 'address',
        'phone' => 'phone',
        'mobile' => 'mobile',
        'day' => 'day',
        'month' => 'month',
        'year' => 'year',
        'hour' => 'hour',
        'minute' => 'minute',
        'second' => 'second',
        'title' => 'title',
        'content' => 'content',
        'description' => 'description',
        'excerpt' => 'excerpt',
        'date' => 'date',
        'time' => 'time',
        'available' => 'available',
        'image'=>'image ',
        'about'=>'about us',
        'photo' =>'photo',
        'edit_name'=>'edit_name',
        'edit_phone'=>'edit_phone',
        'edit_about'=>'edit_about',
        'edit_photo'=>'edit_photo',
        'counter' =>'counter',
        'edit_content' =>'edit_content',
        'add_logo' =>'add logo',
        'edit_logo' =>'edit logo',

        'sms_message' =>'sms message',
        'email_message' =>'email message',

        'avatar' =>'avatar',
        'end_date' => 'end date',
        'start_date' => 'start date',
        'project_id' => 'project',
        'category_id'=> 'category ',
        'service_id' => 'service',
        'lat'        => ' location ',
        'long'        => ' location',
        'subject'  => ' subject ',
        'rating'   => 'rating',
        'code'     => ' code',
        'edit_code'     => ' code',
        'role'     => 'role',
        'edit_role'     => 'role',
        'type'     => 'type',
        'edit_type'     => 'type',
        'end_at'   => 'end at',
        'edit_end_at' => 'end at',
        'today'    => 'today',
        'value'    => 'value',
        'edit_value'    => 'value',
        'num_to_use' => 'num to use',
        'edit_num_to_use' => 'num to use',
        'receive_address'      => 'receive address',
        'edit_receive_address' => 'receive address',
        'deliver_address'      => 'deliver address',
        'edit_deliver_address' => 'deliver address',
        'description'          => 'description',
        'edit_description'     => 'description',
        'reason_ar'            => 'reason in arabic',
        'reason_en'            => 'reason in english',
        'edit_reason_ar'       => 'reason in arabic',
        'edit_reason_en'       => 'reason in english',
        'price'                => 'price',
        'edit_price'           => 'price',
        'device_id'            => 'sign out',
        'store_id'             => 'store',
        'family_id'            => 'family',
        "phone_code"           => "country code" ,
        "code_verified"        => "code verified",
        "lang"				   => "Langue",
        "section_id"		   => "sport"	,
        "vendor_id"			   => "Venor"	,
		"price_before"	       => "Price Before",
		"price_after"	       => "Price After ",
		"start_at"			   => "Start At ",
        "end_at"			   => "End At"	  ,
        "user_id"			   => "Owner auction"	,
		"owner_id"			   => "Woner Auction"	,
		"default"         => "Main Image"          ,
        "sender.name"				=> "Sender Name",
		"sender.mobile"				=> "Sender Mobile",
		"sender.national_card"		=> "Sender National Id",
		"sender.address"			=> "Sender Address",
		"sender.card_image"			=> "Sender National card Image",

		"reciever.name"				=> "Sender Name",
		"reciever.mobile"		    => "Sender Mobile",
		"reciever.national_card"    => "Sender National Id",
		"reciever.address"			=> "Sender Address",
		"reciever.card_image"		=> "Sender National card Image",
        "c_attributes"   => "attributes",
		"c_attributes.*" => "Attributes.*",
        "office"					=> "Office Date ",
		"office.title"				=> "Office Title",
		"office.description"		=> "Office Description",
		"office.mobile"		=> "Office Mobile",
		"office.image"		=> "Office Image",
		"office.country_id"	=> "Office Country",
		"office.city_id"	=> "Office City",
		"office.state_id"	=> "Office State",
        "use_pakcage_info"  => "Use Pakcage Info ",
		"subscription.current_use" => "cuttent Use subscription",
		"subscription.max_use" => "Max Use subscription ",
		"subscription.end_at"  => "Subscription end at"	,
		"subscription.start_at"  => "Subscription start at"	,
		"subscription.money"  => "Subscription price"	,
        "subscription.duration_of_ads"	=> "Subscription Period to show ads ",
        "agree_policy"   => "Agree Policy",
        "country_id"	=> "Country",
		"city_id"	=> "City",
		"state_id"	=> "State",

    ],

];
