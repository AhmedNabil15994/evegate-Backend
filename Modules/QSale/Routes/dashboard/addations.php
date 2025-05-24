<?php

Route::group(['prefix' => 'addations'], function () {

  	Route::get('/' ,'AddationController@index')
  	->name('dashboard.addations.index')
    ->middleware(['permission:show_addations']);

  	Route::get('datatable'	,'AddationController@datatable')
  	->name('dashboard.addations.datatable')
  	->middleware(['permission:show_addations']);

  	Route::get('create'		,'AddationController@create')
  	->name('dashboard.addations.create')
    ->middleware(['permission:add_addations']);

  	Route::post('/'			,'AddationController@store')
  	->name('dashboard.addations.store')
    ->middleware(['permission:add_addations']);

  	Route::get('{id}/edit'	,'AddationController@edit')
  	->name('dashboard.addations.edit')
    ->middleware(['permission:edit_addations']);

  	Route::put('{id}'		,'AddationController@update')
  	->name('dashboard.addations.update')
    ->middleware(['permission:edit_addations']);

  	Route::delete('{id}'	,'AddationController@destroy')
  	->name('dashboard.addations.destroy')
    ->middleware(['permission:delete_addations']);

  	Route::get('deletes'	,'AddationController@deletes')
  	->name('dashboard.addations.deletes')
    ->middleware(['permission:delete_addations']);

  	Route::get('{id}','AddationController@show')
  	->name('dashboard.addations.show')
    ->middleware(['permission:show_addations']);

});