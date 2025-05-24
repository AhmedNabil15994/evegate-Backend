<?php

Route::group(['prefix' => 'workers'], function () {

  	Route::get('/' ,'WorkerController@index')
  	->name('vendor.workers.index')
    ->middleware(['permission:show_workers']);

  	Route::get('datatable'	,'WorkerController@datatable')
  	->name('vendor.workers.datatable')
  	->middleware(['permission:show_workers']);

  	Route::get('create'		,'WorkerController@create')
  	->name('vendor.workers.create')
    ->middleware(['permission:add_workers']);

  	Route::post('/'			,'WorkerController@store')
  	->name('vendor.workers.store')
    ->middleware(['permission:add_workers']);

  	Route::get('{id}/edit'	,'WorkerController@edit')
  	->name('vendor.workers.edit')
    ->middleware(['permission:edit_workers']);

  	Route::put('{id}'		,'WorkerController@update')
  	->name('vendor.workers.update')
    ->middleware(['permission:edit_workers']);

  	Route::delete('{id}'	,'WorkerController@destroy')
  	->name('vendor.workers.destroy')
    ->middleware(['permission:delete_workers']);

  	Route::get('deletes'	,'WorkerController@deletes')
  	->name('vendor.workers.deletes')
    ->middleware(['permission:delete_workers']);

  	// Route::get('{id}','WorkerController@show')
  	// ->name('vendor.workers.show')
    // ->middleware(['permission:show_workers']);

});
