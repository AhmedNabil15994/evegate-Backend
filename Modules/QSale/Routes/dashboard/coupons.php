<?php

Route::group(['prefix' => 'coupons'], function () {

  	Route::get('/' ,'CouponController@index')
  	->name('dashboard.coupons.index')
    ->middleware(['permission:show_coupons']);

  	Route::get('datatable'	,'CouponController@datatable')
  	->name('dashboard.coupons.datatable')
  	->middleware(['permission:show_coupons']);

  	Route::get('create'		,'CouponController@create')
  	->name('dashboard.coupons.create')
    ->middleware(['permission:add_coupons']);

  	Route::post('/'			,'CouponController@store')
  	->name('dashboard.coupons.store')
    ->middleware(['permission:add_coupons']);

  	Route::get('{id}/edit'	,'CouponController@edit')
  	->name('dashboard.coupons.edit')
    ->middleware(['permission:edit_coupons']);

  	Route::put('{id}'		,'CouponController@update')
  	->name('dashboard.coupons.update')
    ->middleware(['permission:edit_coupons']);

  	Route::delete('{id}'	,'CouponController@destroy')
  	->name('dashboard.coupons.destroy')
    ->middleware(['permission:delete_coupons']);

  	Route::get('deletes'	,'CouponController@deletes')
  	->name('dashboard.coupons.deletes')
    ->middleware(['permission:delete_coupons']);

  	Route::get('{id}','CouponController@show')
  	->name('dashboard.coupons.show')
    ->middleware(['permission:show_coupons']);

});