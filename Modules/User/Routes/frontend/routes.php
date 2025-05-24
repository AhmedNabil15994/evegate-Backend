<?php

 //profile
 Route::group(['prefix' => 'profile','middleware' => 'auth'], function ($profileRoute) {
     $profileRoute->get("/", "UserController@profile")->name("frontend.user.my-profile");
     $profileRoute->get("/info", "UserController@info")->name("frontend.user.edit_info");
     $profileRoute->post("/info", "UserController@updateInfo")->name("frontend.user.edit_info.save");
     $profileRoute->get("/office", "UserController@createOrUpdateOffice")->name("frontend.office.create");
     $profileRoute->post("/office", "UserController@storeOrUpdateOffice")->name("frontend.office.store");
     $profileRoute->get("/my-ads", "UserController@myAds")->name("frontend.user.my_ads");
     $profileRoute->get("/verify", "UserController@verify")->name("frontend.user.verify");
     $profileRoute->post("/verify", "UserController@verified")->name("frontend.user.verified");
     $profileRoute->get("/create-ad", "UserController@createAds")
                ->middleware("auth.is_allow")
                ->name("frontend.user.create_ad");
     $profileRoute->get("/edit-ad/{id}", "UserController@editMyAd")
                    
                    ->name("frontend.user.edit_ad");

     $profileRoute->get("/my-favorites", "UserController@myFavorites")->name("frontend.user.my_favorites");
     $profileRoute->any("/toggle-favorite/{id}", "UserController@toggleFavorite")->name("frontend.user.toggle_favorites");
 });
