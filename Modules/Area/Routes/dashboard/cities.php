<?php

Route::group(['prefix' => 'cities'], function () {

  	Route::get('/' ,'CityController@index')
  	->name('dashboard.cities.index')
    ->middleware(['permission:show_cities']);

    Route::get('datatable'	,'CityController@datatable')
    ->name('dashboard.cities.datatable')
    ->middleware(['permission:show_cities']);

  	Route::get('create'		,'CityController@create')
  	->name('dashboard.cities.create')
    ->middleware(['permission:add_cities']);

  	Route::post('/'			,'CityController@store')
  	->name('dashboard.cities.store')
    ->middleware(['permission:add_cities']);

  	Route::get('{id}/edit'	,'CityController@edit')
  	->name('dashboard.cities.edit')
    ->middleware(['permission:edit_cities']);

  	Route::put('{id}'		,'CityController@update')
  	->name('dashboard.cities.update')
    ->middleware(['permission:edit_cities']);

  	Route::delete('{id}'	,'CityController@destroy')
  	->name('dashboard.cities.destroy')
    ->middleware(['permission:delete_cities']);

  	Route::get('deletes'	,'CityController@deletes')
  	->name('dashboard.cities.deletes')
    ->middleware(['permission:delete_cities']);

  	Route::get('{id}','CityController@show')
  	->name('dashboard.cities.show')
    ->middleware(['permission:show_cities']);

});
