<?php

Route::group(['prefix' => 'countries'], function () {

  	Route::get('/' ,'CountryController@index')
  	->name('dashboard.countries.index')
    ->middleware(['permission:show_countries']);

  	Route::get('datatable'	,'CountryController@datatable')
  	->name('dashboard.countries.datatable')
  	->middleware(['permission:show_countries']);

  	Route::get('create'		,'CountryController@create')
  	->name('dashboard.countries.create')
    ->middleware(['permission:add_countries']);

  	Route::post('/'			,'CountryController@store')
  	->name('dashboard.countries.store')
    ->middleware(['permission:add_countries']);

  	Route::get('{id}/edit'	,'CountryController@edit')
  	->name('dashboard.countries.edit')
    ->middleware(['permission:edit_countries']);

  	Route::put('{id}'		,'CountryController@update')
  	->name('dashboard.countries.update')
    ->middleware(['permission:edit_countries']);

  	Route::delete('{id}'	,'CountryController@destroy')
  	->name('dashboard.countries.destroy')
    ->middleware(['permission:delete_countries']);

  	Route::get('deletes'	,'CountryController@deletes')
  	->name('dashboard.countries.deletes')
    ->middleware(['permission:delete_countries']);

  	Route::get('{id}','CountryController@show')
  	->name('dashboard.countries.show')
    ->middleware(['permission:show_countries']);

});
