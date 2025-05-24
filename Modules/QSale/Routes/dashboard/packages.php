<?php

Route::group(['prefix' => 'packages'], function () {

  	Route::get('/' ,'PackageController@index')
  	->name('dashboard.packages.index')
    ->middleware(['permission:show_packages']);

  	Route::get('datatable'	,'PackageController@datatable')
  	->name('dashboard.packages.datatable')
  	->middleware(['permission:show_packages']);

  	Route::get('create'		,'PackageController@create')
  	->name('dashboard.packages.create')
    ->middleware(['permission:add_packages']);

  	Route::post('/'			,'PackageController@store')
  	->name('dashboard.packages.store')
    ->middleware(['permission:add_packages']);

  	Route::get('{id}/edit'	,'PackageController@edit')
  	->name('dashboard.packages.edit')
    ->middleware(['permission:edit_packages']);

  	Route::put('{id}'		,'PackageController@update')
  	->name('dashboard.packages.update')
    ->middleware(['permission:edit_packages']);

  	Route::delete('{id}'	,'PackageController@destroy')
  	->name('dashboard.packages.destroy')
    ->middleware(['permission:delete_packages']);

  	Route::get('deletes'	,'PackageController@deletes')
  	->name('dashboard.packages.deletes')
    ->middleware(['permission:delete_packages']);

  	Route::get('{id}','PackageController@show')
  	->name('dashboard.packages.show')
    ->middleware(['permission:show_packages']);

});