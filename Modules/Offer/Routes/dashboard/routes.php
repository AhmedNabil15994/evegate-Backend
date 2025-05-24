<?php

Route::group(['prefix' => 'offers'], function () {

  	Route::get('/' ,'OfferController@index')
  	->name('dashboard.offers.index')
    ->middleware(['permission:show_offers']);

  	Route::get('datatable'	,'OfferController@datatable')
  	->name('dashboard.offers.datatable')
  	->middleware(['permission:show_offers']);

  	Route::get('create'		,'OfferController@create')
  	->name('dashboard.offers.create')
    ->middleware(['permission:add_offers']);

  	Route::post('/'			,'OfferController@store')
  	->name('dashboard.offers.store')
    ->middleware(['permission:add_offers']);

  	Route::get('{id}/edit'	,'OfferController@edit')
  	->name('dashboard.offers.edit')
    ->middleware(['permission:edit_offers']);

  	Route::put('{id}'		,'OfferController@update')
  	->name('dashboard.offers.update')
    ->middleware(['permission:edit_offers']);

  	Route::delete('{id}'	,'OfferController@destroy')
  	->name('dashboard.offers.destroy')
    ->middleware(['permission:delete_offers']);

  	Route::get('deletes'	,'OfferController@deletes')
  	->name('dashboard.offers.deletes')
    ->middleware(['permission:delete_offers']);

  	Route::get('{id}','OfferController@show')
  	->name('dashboard.offers.show')
    ->middleware(['permission:show_offers']);

});