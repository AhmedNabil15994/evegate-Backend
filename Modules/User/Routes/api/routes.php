<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ===================users=======================
Route::get('/user', 'UserController@index')->name('api.users.profile');
Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function () {
    Route::get('profile', 'UserController@profile')->name('api.users.profile');
    Route::post('profile', 'UserController@updateProfile')->name('api.users.profile');
    // Route::post('office', 'UserController@updateOrCreateOffice')->name('api.users.profile');
    Route::post('reset-password', 'UserController@resetPassword')->name('api.users.resetPassword');
    Route::post("setting", "UserController@updateSetting");
    Route::post("test-fcm", "UserController@testFcm");
    Route::get("notifcations", "UserController@notifications");

    Route::delete('delete-account', 'UserController@deleteUserAccount')->name('api.users.delete_account');
});


Route::group(["prefix" => "user"], function () {
    Route::post("/rates", "UserController@rate")->middleware("auth:api");
    Route::get("/{id}/current-rate", "UserController@getRate");
});

Route::post('/user/get-verified', 'UserController@getVerifiedCode');

Route::get("socials/list", "SocialsController@index");


Route::post("/delete-subscription", function (Request $request) {
    if ($sub = auth('api')->user()->subscription) {
        $sub->delete();
    };

    return response()->json('deleted successfully');
});
