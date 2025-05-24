<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'CategoryController@categories')->middleware('cacheResponse');
    Route::get('/tree', 'CategoryController@tree')->middleware('cacheResponse');
    Route::get('/{id}', 'CategoryController@show')->middleware('cacheResponse');
    Route::get('/{id}/child', 'CategoryController@child')->middleware('cacheResponse');
});
