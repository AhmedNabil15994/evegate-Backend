<?php
Route::group(['prefix' => 'advertisement', 'middleware' => 'dashboard.auth'], function () {
    Route::get('/', 'AdvertisementController@index')
    ->name('dashboard.advertisement.index')
  ->middleware(['permission:show_advertisement']);

    Route::get('datatable', 'AdvertisementController@datatable')
  ->name('dashboard.advertisement.datatable')
  ->middleware(['permission:show_advertisement']);

    Route::get('create', 'AdvertisementController@create')
    ->name('dashboard.advertisement.create')
  ->middleware(['permission:add_advertisement']);

    Route::post('/', 'AdvertisementController@store')
    ->name('dashboard.advertisement.store')
  ->middleware(['permission:add_advertisement']);

    Route::get('{id}/edit', 'AdvertisementController@edit')
    ->name('dashboard.advertisement.edit')
  ->middleware(['permission:edit_advertisement']);

    Route::put('{id}', 'AdvertisementController@update')
    ->name('dashboard.advertisement.update')
  ->middleware(['permission:edit_advertisement']);

    Route::delete('{id}', 'AdvertisementController@destroy')
    ->name('dashboard.advertisement.destroy')
  ->middleware(['permission:delete_advertisement']);

    Route::get('deletes', 'AdvertisementController@deletes')
    ->name('dashboard.advertisement.deletes')
  ->middleware(['permission:delete_advertisement']);

    Route::get('{id}', 'AdvertisementController@show')
    ->name('dashboard.advertisement.show')
  ->middleware(['permission:show_advertisement']);
});
