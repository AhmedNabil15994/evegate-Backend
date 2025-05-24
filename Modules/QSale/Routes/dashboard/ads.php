<?php

use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'ads'], function () {
    Route::get('/', 'AdsController@index')
        ->name('dashboard.ads.index')
        ->middleware(['permission:show_ads']);

    Route::get('datatable', 'AdsController@datatable')
        ->name('dashboard.ads.datatable')
        ->middleware(['permission:show_ads']);

    Route::get('select2-data', 'AdsController@select2')
        ->name('dashboard.ads.select2');
    Route::get('create', 'AdsController@create')
        ->name('dashboard.ads.create')
        ->middleware(['permission:add_ads']);

    Route::post('/', 'AdsController@store')
        ->name('dashboard.ads.store')
        ->middleware(['permission:add_ads']);

    Route::get('{id}/edit', 'AdsController@edit')
        ->name('dashboard.ads.edit')
        ->middleware(['permission:edit_ads']);



    Route::get('{ads}/add/additions', 'AdsAdditionsController@add')
        ->name('dashboard.ads.add.additions')
        ->middleware(['permission:edit_ads']);

    Route::post('{ads}/add/additions', 'AdsAdditionsController@store')
        ->name('dashboard.ads.store.additions')
        ->middleware(['permission:edit_ads']);

    Route::get('{ads}/edit/additions', 'AdsAdditionsController@edit')
        ->name('dashboard.ads.edit.additions')
        ->middleware(['permission:edit_ads']);


    Route::put('{ads}/update/additions', 'AdsAdditionsController@update')
        ->name('dashboard.ads.update.additions')
        ->middleware(['permission:edit_ads']);
    Route::put('{id}', 'AdsController@update')
        ->name('dashboard.ads.update')
        ->middleware(['permission:edit_ads']);

    Route::delete('{id}', 'AdsController@destroy')
        ->name('dashboard.ads.destroy')
        ->middleware(['permission:delete_ads']);

    Route::get('deletes', 'AdsController@deletes')
        ->name('dashboard.ads.deletes')
        ->middleware(['permission:delete_ads']);

    Route::get('{id}', 'AdsController@show')
        ->name('dashboard.ads.show')
        ->middleware(['permission:show_ads']);

    Route::get('{id}/complaints', 'AdsController@complaientDatatable')
        ->name('dashboard.ads.complaints')
        ->middleware(['permission:show_ads']);
});
