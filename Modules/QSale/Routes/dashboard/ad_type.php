<?php

Route::group(['prefix' => 'ad-types'], function () {

  	Route::get('/' ,'AdTypeController@index')
  	->name('dashboard.ad_types.index')
    ->middleware(['permission:show_ad_types']);

  	Route::get('datatable'	,'AdTypeController@datatable')
  	->name('dashboard.ad_types.datatable')
  	->middleware(['permission:show_ad_types']);

  	Route::get('create'		,'AdTypeController@create')
  	->name('dashboard.ad_types.create')
    ->middleware(['permission:add_ad_types']);

  	Route::post('/'			,'AdTypeController@store')
  	->name('dashboard.ad_types.store')
    ->middleware(['permission:add_ad_types']);

  	Route::get('{id}/edit'	,'AdTypeController@edit')
  	->name('dashboard.ad_types.edit')
    ->middleware(['permission:edit_ad_types']);

  	Route::put('{id}'		,'AdTypeController@update')
  	->name('dashboard.ad_types.update')
    ->middleware(['permission:edit_ad_types']);

  	Route::delete('{id}'	,'AdTypeController@destroy')
  	->name('dashboard.ad_types.destroy')
    ->middleware(['permission:delete_ad_types']);

  	Route::get('deletes'	,'AdTypeController@deletes')
  	->name('dashboard.ad_types.deletes')
    ->middleware(['permission:delete_ad_types']);

  	Route::get('{id}','AdTypeController@show')
  	->name('dashboard.ad_types.show')
    ->middleware(['permission:show_ad_types']);

});