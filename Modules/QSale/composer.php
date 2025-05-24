<?php

view()->composer([
    "user::dashboard.users.*" ,
    'user::dashboard.companies.create',
    'user::dashboard.companies.edit',
    'user::dashboard.technicals.create',
    'user::dashboard.technicals.edit',
 ], \Modules\QSale\ViewComposers\Dashboard\PackageComposer::class);

 view()->composer([
    "qsale::dashboard.ads.create", "qsale::dashboard.ads.edit" ,
    "user::frontend.create-ads" ,
  
 ], \Modules\QSale\ViewComposers\Dashboard\AddationsComposer::class);


 view()->composer([
   "qsale::dashboard.ads.create", "qsale::dashboard.ads.edit" ,
   "user::frontend.create-ads" ,"user::frontend.edit-ads" ,
 
], \Modules\QSale\ViewComposers\Dashboard\AdTypeComposer::class);

 view()->composer([
   "apps::frontend.layouts._footer"
 
   ], \Modules\QSale\ViewComposers\Frontend\AdsCountComposer::class);
