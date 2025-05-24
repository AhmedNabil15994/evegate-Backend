<?php

use Illuminate\Support\Facades\Route;
// packages
Route::group(['prefix' => 'packages'], function () {
    Route::get('/', 'PackageController@index');
    Route::get('/{id}', 'PackageController@show');
});
// coupons
Route::group(['prefix' => 'coupons'], function () {
    Route::post('/check', 'CouponController@check');
});

// republished
Route::group(['prefix' => 'republished-packages'], function () {
    Route::get('/', 'RepublishedPackageController@index');
    Route::get('/{id}', 'RepublishedPackageController@show');
});

// ============================== Addations ===================================

// addations
Route::group(['prefix' => 'addations'], function () {
    Route::get('/', 'AddationController@index')->middleware('cacheResponse');
    Route::get('/type/ads', 'AddationController@listAdsBasedType');
    Route::get('/{id}/list-ads', 'AddationController@listAds')->middleware('cacheResponse');;
});

// ============================== ad types ===================================

// ad type
Route::group(['prefix' => 'ad-types'], function () {
    Route::get('/', 'AdTypeController@index')->middleware('cacheResponse');
    Route::get('/{id}/list-ads', 'AdTypeController@listAds')->middleware('cacheResponse');;
});

// ============================== Ads ===========================================

// ads
Route::group(['prefix' => 'ads'], function () {
    // auth must
    Route::group(['middleware' => ['auth:api', "auth.is_allow"]], function () {
        Route::post('/', 'AdsController@store');
        Route::get('/current', 'AdsController@current');

        // ->middleware('cacheResponse')
        Route::get('/me', 'AdsController@adsMe');
        // ->middleware('cacheResponse');
        Route::post('/{id}', 'AdsController@update');
        Route::post('/{id}/update', 'AdsController@updateAfterCreate');
        Route::delete('/{id}', 'AdsController@delete');
        Route::post('/{id}/confirm', 'AdsController@confirm');
        Route::post('/{id}/addations', 'AdsOrderController@create');
        Route::post('/{id}/republish', 'RepublishedPackageController@republishAdsRequest');
    });

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/favorites', 'FavoriteController@index');
        Route::group(['prefix' => "{id}/favorites"], function () {
            Route::post("/", "FavoriteController@add");
            Route::delete("/", "FavoriteController@remove");
            Route::post("/toggle", "FavoriteController@toggle");
        });
    });

    // favourite FavoriteController
    Route::group(['prefix' => "{id}/attach-seen"], function () {
        Route::post("/", "AdsSeenController@attach");
    });

    //global api
    Route::get("/", 'AdsController@index');
    // ->middleware('cacheResponse
    Route::get('/{id}', 'AdsController@show');
    Route::get('/{id}/related', 'AdsController@related');
    Route::post('/{id}/report', 'AdsController@createCompliant');
    Route::post('/{id}/show', 'AdsController@incrementView');
    Route::get('/{id}/check-favorite', 'FavoriteController@checkIfAdd');
});



// ============================== Subscription ===========================================
// Subscription
Route::group(['prefix' => 'subscription'], function () {

    // auth must
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/current', 'SubscriptionController@current');
        Route::get('/me', 'SubscriptionController@me');
        Route::post("/{id}/set-default", "SubscriptionController@markDefault");
        Route::post("/{id}/renewal", "SubscriptionController@renewal");
        Route::post("/packages/{id}", "SubscriptionController@subscriptionPackage");
    });
    //global api
});

// ============================== Office ===========================================
// Office
Route::group(['prefix' => 'offices'], function () {

    // auth must
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/current', 'OfficeController@currentOffice');
    });
    //global api
    Route::get("/", "OfficeController@index");
    Route::get("/{id}", "OfficeController@show");
    Route::get("/{id}/ads", "OfficeController@getAds");
});

// ============================== Home ===========================================

// home
Route::group(['prefix' => 'home'], function () {
    //global api
    Route::get("/", 'HomeController@index')->middleware('cacheResponse');
});

// =============================== payments ===================================
Route::group(['prefix' => 'payment'], function () {
    Route::get('/success', 'PaymentController@success')->name("api.payment.success");
    Route::get('/failed', 'PaymentController@failed')->name("api.payment.failed");

    Route::get('/success-myfatoorah', 'PaymentController@successMFatoorah')
        ->name("api.payment.myfatoorah.success");
    Route::get('/failed-myfatoorah', 'PaymentController@failedMFatoorah')
        ->name("api.payment.myfatoorah.failed");
});

// companies ============================================================
Route::group(['prefix' => 'companies'], function ($route) {
    $route->get("/", "CompanyController@index");
    $route->get("/{id}", "CompanyController@show");
    $route->get("/{id}/ads", "CompanyController@getAds");
});

// technicals ============================================================
Route::group(['prefix' => 'technicals'], function ($route) {
    $route->get("/", "TechnicalController@index");
    $route->get("/{id}", "TechnicalController@show");
    $route->get("/{id}/ads", "TechnicalController@getAds");
});

// technicals ============================================================
Route::group(['prefix' => 'coins'], function ($route) {
    $route->get("/", "CoinController@list");
    Route::group(['middleware' => 'auth:api'], function ($route) {
        $route->post("/", "CoinController@createPaymentTransaction");
        $route->put("/", "CoinController@updatePaymentTransaction");
    });
});
