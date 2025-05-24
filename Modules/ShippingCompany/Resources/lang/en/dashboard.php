<?php

return [

  'shipping_companies'  => [
    'datatable' => [
      'created_at'    => 'Created At',
      'date_range'    => 'Search By Dates',
      'options'       => 'Options',
      'status'        => 'Status',
      'title'         => 'Title',
      'description'       => 'Description',
      "phone_number"            => "phone number",
      "phone_whatsapp"        => "phone whatsapp",
      "image"             => "Image",
      "percent"     => "Percent",
            'name'          => 'name',
      "start_at"  => "Start At",
      "end_at" => "End at",
      "category_id" => "category",
    ],
    'form'      => [
      "price_after"   => "Price after discount",
      "price_before"  => "Price before discount",
      'status'        => 'Status',
      'title'         => 'Title',
      'name'          => 'name',
      "address"       => "address",
      "image"         => "Image",
      "percent"       => "Percent",
      "start_at"      => "Start At",
      "phone_number"  => "phone number",
      "phone_whatsapp" => "phone whatsapp",
      "end_at" => "End at",
      "category_id" => "category",
      'tabs'              => [
        'general'   => 'General Info.',
      ],

    ],
    'routes'    => [
      'create'    => 'Create ShippingCompany',
      'index'     => 'ShippingCompanies',
      'update'    => 'Edit ShippingCompany',
    ],

  ],

];
