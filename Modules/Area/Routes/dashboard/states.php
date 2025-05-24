<?php

Route::group(['prefix' => 'states'], function () {

  	Route::get('/' ,'StateController@index')
  	->name('dashboard.states.index')
    ->middleware(['permission:show_states']);

  	Route::get('datatable'	,'StateController@datatable')
  	->name('dashboard.states.datatable')
  	->middleware(['permission:show_states']);

  	Route::get('create'		,'StateController@create')
  	->name('dashboard.states.create')
    ->middleware(['permission:add_states']);

  	Route::post('/'			,'StateController@store')
  	->name('dashboard.states.store')
    ->middleware(['permission:add_states']);

  	Route::get('{id}/edit'	,'StateController@edit')
  	->name('dashboard.states.edit')
    ->middleware(['permission:edit_states']);

  	Route::put('{id}'		,'StateController@update')
  	->name('dashboard.states.update')
    ->middleware(['permission:edit_states']);

  	Route::delete('{id}'	,'StateController@destroy')
  	->name('dashboard.states.destroy')
    ->middleware(['permission:delete_states']);

  	Route::get('deletes'	,'StateController@deletes')
  	->name('dashboard.states.deletes')
    ->middleware(['permission:delete_states']);

  	Route::get('{id}','StateController@show')
  	->name('dashboard.states.show')
    ->middleware(['permission:show_states']);

});
