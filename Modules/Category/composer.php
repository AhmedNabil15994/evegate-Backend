<?php

// Dashboard ViewComposr
view()->composer([

  'worker::dashboard.workers.*',
  'user::dashboard.users.*',
  'vendor::dashboard.vendors.*',
  // "qsale::dashboard.ads.*",
  // "slider::dashboard.create",
  // "slider::dashboard.edit",
  "setting::dashboard.index"

], \Modules\Category\ViewComposers\Dashboard\CategoryComposer::class);


view()->composer([
  'category::dashboard.categories.create',
  "qsale::dashboard.ads.create",
  "slider::dashboard.create" ,
  "slider::dashboard.edit",
], \Modules\Category\ViewComposers\Dashboard\NormalCategoryComposer::class);

view()->composer([
  'category::dashboard.categories.create',
  'user::dashboard.companies.create',
  "qsale::dashboard.ads.create",
  "slider::dashboard.create" ,
  "slider::dashboard.edit",
], \Modules\Category\ViewComposers\Dashboard\CompanyCategoryComposer::class);

view()->composer([
  'category::dashboard.categories.create',
  "qsale::dashboard.ads.create",
  "slider::dashboard.create" ,
  "slider::dashboard.edit",
], \Modules\Category\ViewComposers\Dashboard\TechnicalCategoryComposer::class);

view()->composer([
  'category::dashboard.categories.create',
  "offer::dashboard.create",
  "offer::dashboard.edit",
], \Modules\Category\ViewComposers\Dashboard\OfferCategoryComposer::class);

view()->composer([
  'apps::dashboard.index',
], \Modules\Category\ViewComposers\Dashboard\CountCategoryComposer::class);

view()->composer([
  'advertising::dashboard.advertising.*',
], \Modules\Category\ViewComposers\Dashboard\CategoryAllComposer::class);



view()->composer([
  'vendor::vendor.offers.*',
], \Modules\Category\ViewComposers\Vendor\CategoryComposer::class);


view()->composer([
  'apps::frontend.layouts.*' ,
  "apps::frontend.index", "qsale::frontend.index" ,
  "user::frontend.create-ads" ,
  "user::frontend.edit-ads"
], \Modules\Category\ViewComposers\FrontEnd\CategoryComposer::class);
