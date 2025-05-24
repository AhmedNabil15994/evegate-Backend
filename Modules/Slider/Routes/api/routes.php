<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'slider'], function () {

    Route::get('/', 'SliderController@slider')->name('api.slider.index');
});
