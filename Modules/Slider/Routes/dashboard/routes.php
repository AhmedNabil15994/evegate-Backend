<?php

Route::group(['prefix' => 'slider', 'middleware' => 'dashboard.auth'], function () {

  	Route::get('/' ,'SliderController@index')
  	->name('dashboard.slider.index')
    ->middleware(['permission:show_slider']);

    Route::get('datatable'	,'SliderController@datatable')
    ->name('dashboard.slider.datatable')
    ->middleware(['permission:show_slider']);

  	Route::get('create'		,'SliderController@create')
  	->name('dashboard.slider.create')
    ->middleware(['permission:add_slider']);

  	Route::post('/'			,'SliderController@store')
  	->name('dashboard.slider.store')
    ->middleware(['permission:add_slider']);

  	Route::get('{id}/edit'	,'SliderController@edit')
  	->name('dashboard.slider.edit')
    ->middleware(['permission:edit_slider']);

  	Route::put('{id}'		,'SliderController@update')
  	->name('dashboard.slider.update')
    ->middleware(['permission:edit_slider']);

  	Route::delete('{id}'	,'SliderController@destroy')
  	->name('dashboard.slider.destroy')
    ->middleware(['permission:delete_slider']);

  	Route::get('deletes'	,'SliderController@deletes')
  	->name('dashboard.slider.deletes')
    ->middleware(['permission:delete_slider']);

  	Route::get('{id}','SliderController@show')
  	->name('dashboard.slider.show')
    ->middleware(['permission:show_slider']);

});
