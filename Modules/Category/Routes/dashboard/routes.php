<?php

Route::group(['prefix' => 'categories'], function () {

  	Route::get('/' ,'CategoryController@index')
  	->name('dashboard.categories.index')
    ->middleware(['permission:show_categories']);

  	Route::get('datatable'	,'CategoryController@datatable')
  	->name('dashboard.categories.datatable')
  	->middleware(['permission:show_categories']);

  	Route::get('create'		,'CategoryController@create')
  	->name('dashboard.categories.create')
    ->middleware(['permission:add_categories']);

  	Route::post('/'			,'CategoryController@store')
  	->name('dashboard.categories.store')
    ->middleware(['permission:add_categories']);

  	Route::get('{id}/edit'	,'CategoryController@edit')
  	->name('dashboard.categories.edit')
    ->middleware(['permission:edit_categories']);

  	Route::put('{id}'		,'CategoryController@update')
  	->name('dashboard.categories.update')
    ->middleware(['permission:edit_categories']);

  	Route::delete('{id}'	,'CategoryController@destroy')
  	->name('dashboard.categories.destroy')
    ->middleware(['permission:delete_categories']);

  	Route::get('deletes'	,'CategoryController@deletes')
  	->name('dashboard.categories.deletes')
    ->middleware(['permission:delete_categories']);

  	Route::get('{id}','CategoryController@show')
  	->name('dashboard.categories.show')
    ->middleware(['permission:show_categories']);

});
