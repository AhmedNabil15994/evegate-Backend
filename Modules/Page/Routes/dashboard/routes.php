<?php

Route::group(['prefix' => 'pages'], function () {

  	Route::get('/' ,'PageController@index')
  	->name('dashboard.pages.index')
    ->middleware(['permission:show_pages']);

  	Route::get('datatable'	,'PageController@datatable')
  	->name('dashboard.pages.datatable')
  	->middleware(['permission:show_pages']);

  	Route::get('create'		,'PageController@create')
  	->name('dashboard.pages.create')
    ->middleware(['permission:add_pages']);

  	Route::post('/'			,'PageController@store')
  	->name('dashboard.pages.store')
    ->middleware(['permission:add_pages']);

  	Route::get('{id}/edit'	,'PageController@edit')
  	->name('dashboard.pages.edit')
    ->middleware(['permission:edit_pages']);

  	Route::put('{id}'		,'PageController@update')
  	->name('dashboard.pages.update')
    ->middleware(['permission:edit_pages']);

  	Route::delete('{id}'	,'PageController@destroy')
  	->name('dashboard.pages.destroy')
    ->middleware(['permission:delete_pages']);

  	Route::get('deletes'	,'PageController@deletes')
  	->name('dashboard.pages.deletes')
    ->middleware(['permission:delete_pages']);

  	Route::get('{id}','PageController@show')
  	->name('dashboard.pages.show')
    ->middleware(['permission:show_pages']);

});
