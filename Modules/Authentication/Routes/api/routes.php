<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', "namespace" => "UserApp"], function () {
    Route::post('login', 'LoginController@postLoginMobileOrMail')->name('api.auth.login');
    Route::post('login-mobile', 'LoginController@postMobileLogin');
    Route::post('register', 'RegisterController@register')->name('api.auth.register');
    Route::post('resend-code', 'LoginController@resendCode')->name('api.auth.password.resend');
    Route::post('verified', 'LoginController@verified')->name('api.auth.password.verified');
    Route::post('forget-password', 'ForgotPasswordController@forgetPassword')->name('api.auth.password.forget');
    Route::post('forget-password-mobile', 'ForgotPasswordController@forgetPasswordMobile');
    Route::post('reset-password-mobile', 'ForgotPasswordController@resetPasswordMobile');
    Route::group(['prefix' => '/', 'middleware' => 'auth:api'], function () {
        Route::post('logout', 'LoginController@logout')->name('api.auth.logout');
        Route::delete('delete-account', 'LoginController@deleteAccount')->name('api.auth.delete.account');
    });
});

Route::group(['prefix' => 'firebase', "namespace" => "UserApp"], function () {
    Route::post('check-mobile', 'FireBaseController@checkMobile');
    Route::post('reset-password', 'FireBaseController@resetPassword');
});
