<?php

view()->composer([
    'area::dashboard.cities.*', 'user::dashboard.users.*' ,
    "qsale::dashboard.ads.create", "qsale::dashboard.ads.edit" ,
    "user::frontend.office" ,
    "user::frontend.create-ads" ,
    "user::frontend.edit-ads" ,
    'user::dashboard.companies.create',
    'user::dashboard.companies.edit',
  
    ], \Modules\Area\ViewComposers\Dashboard\CountryComposer::class);

view()->composer([
  
   
    'area::dashboard.states.*',
    "apps::frontend.layouts._header"  ,
    
], \Modules\Area\ViewComposers\Dashboard\CityComposer::class);
