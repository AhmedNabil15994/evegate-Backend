<?php

Route::group(['prefix' => 'categories'], function () {
    Route::get('/index', 'CategoryController@index')->name("frontend.categories.index");
    Route::get('/{slug}/sub-categories', 'CategoryController@show')->name("frontend.categories.show");
});
