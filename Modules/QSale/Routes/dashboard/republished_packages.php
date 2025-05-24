<?php


Route::group(['prefix' => 'republished-packages'], function () {

  	Route::get('/' ,'RepublishedPackageController@index')
  	->name('dashboard.republished_packages.index')
    ->middleware(['permission:show_republished_packages']);

  	Route::get('datatable'	,'RepublishedPackageController@datatable')
  	->name('dashboard.republished_packages.datatable')
  	->middleware(['permission:show_republished_packages']);

  	Route::get('create'		,'RepublishedPackageController@create')
  	->name('dashboard.republished_packages.create')
    ->middleware(['permission:add_republished_packages']);

  	Route::post('/'			,'RepublishedPackageController@store')
  	->name('dashboard.republished_packages.store')
    ->middleware(['permission:add_republished_packages']);

  	Route::get('{id}/edit'	,'RepublishedPackageController@edit')
  	->name('dashboard.republished_packages.edit')
    ->middleware(['permission:edit_republished_packages']);

  	Route::put('{id}'		,'RepublishedPackageController@update')
  	->name('dashboard.republished_packages.update')
    ->middleware(['permission:edit_republished_packages']);

  	Route::delete('{id}'	,'RepublishedPackageController@destroy')
  	->name('dashboard.republished_packages.destroy')
    ->middleware(['permission:delete_republished_packages']);

  	Route::get('deletes'	,'RepublishedPackageController@deletes')
  	->name('dashboard.republished_packages.deletes')
    ->middleware(['permission:delete_republished_packages']);

  	Route::get('{id}','RepublishedPackageController@show')
  	->name('dashboard.republished_packages.show')
    ->middleware(['permission:show_republished_packages']);

});