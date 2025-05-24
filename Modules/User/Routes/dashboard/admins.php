<?php

Route::group(['prefix' => 'admins'], function () {

  	Route::get('/' ,'AdminController@index')
  	->name('dashboard.admins.index')
    ->middleware(['permission:show_admins']);

  	Route::get('datatable'	,'AdminController@datatable')
  	->name('dashboard.admins.datatable')
  	->middleware(['permission:show_admins']);

  	Route::get('create'		,'AdminController@create')
  	->name('dashboard.admins.create')
    ->middleware(['permission:add_admins']);

  	Route::post('/'			,'AdminController@store')
  	->name('dashboard.admins.store')
    ->middleware(['permission:add_admins']);

  	Route::get('{id}/edit'	,'AdminController@edit')
  	->name('dashboard.admins.edit')
    ->middleware(['permission:edit_admins']);

  	Route::put('{id}'		,'AdminController@update')
  	->name('dashboard.admins.update')
    ->middleware(['permission:edit_admins']);

  	Route::delete('{id}'	,'AdminController@destroy')
  	->name('dashboard.admins.destroy')
    ->middleware(['permission:delete_admins']);

  	Route::get('deletes'	,'AdminController@deletes')
  	->name('dashboard.admins.deletes')
    ->middleware(['permission:delete_admins']);

  	Route::get('{id}','AdminController@show')
  	->name('dashboard.admins.show')
    ->middleware(['permission:show_admins']);

});
