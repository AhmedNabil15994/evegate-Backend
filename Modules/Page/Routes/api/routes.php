<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'pages'], function () {

    Route::get('/', 'PageController@pages')->name('api.pages.index');
    Route::get('list-setting', 'PageController@pageSetting')->name('api.pages.show');
    Route::get('{id}', 'PageController@page')->name('api.pages.show');
});
