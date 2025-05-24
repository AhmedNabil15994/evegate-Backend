<?php

Route::group(['prefix' => 'ads'], function ($router) {
    $router->get("/", "AdsController@index")->name("frontend.ads.index");
    $router->get("/{slug}", "AdsController@show")->name("frontend.ads.show");

    $router->group(['middleware' => 'auth'], function ($routerAuth) {
        $routerAuth->post("/", "AdsController@saveAds")
        ->middleware("auth.is_allow")
        ->name("frontend.ads.save_ad");
        $routerAuth->post("/{id}/edit", "AdsController@editMyAd")
        ->name("frontend.ads.edit_save");
        $routerAuth->get("/{id}/preview-payment", "AdsController@previewPayment")
                   ->name("frontend.ads.preview_payment");

        $routerAuth->get("/{id}/republished-packages", "RepublishedPackageController@index")
                   ->name("frontend.ads.republished");
        $routerAuth->post("/{id}/republished-packages", "RepublishedPackageController@republishAdsRequest")
                    ->name("frontend.ads.save_republished");
    });
});


// =============================== payments ===================================
Route::group(['prefix' => 'payment'], function () {
    Route::get('/success', 'PaymentController@success')->name("frontend.payment.success");
    Route::get('/failed', 'PaymentController@failed')->name("frontend.payment.failed");

    Route::get('/success-myfatoorah', 'PaymentController@successMFatoorah')
        ->name("frontend.payment.myfatoorah.success");
    Route::get('/failed-myfatoorah', 'PaymentController@failedMFatoorah')
        ->name("frontend.payment.myfatoorah.failed");
});
