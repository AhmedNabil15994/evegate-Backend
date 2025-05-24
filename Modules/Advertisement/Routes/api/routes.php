<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'advertisements'], function () {
    Route::get('/'      , 'AdvertisementController@index');
});
