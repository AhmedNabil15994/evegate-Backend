<?php

Route::group(['prefix' => 'sections'], function () {

  	Route::get('/' ,'SectionController@index')
  	->name('dashboard.sections.index')
    ->middleware(['permission:show_sections']);

  	Route::get('datatable'	,'SectionController@datatable')
  	->name('dashboard.sections.datatable')
  	->middleware(['permission:show_sections']);

  	Route::get('create'		,'SectionController@create')
  	->name('dashboard.sections.create')
    ->middleware(['permission:add_sections']);

  	Route::post('/'			,'SectionController@store')
  	->name('dashboard.sections.store')
    ->middleware(['permission:add_sections']);

  	Route::get('{id}/edit'	,'SectionController@edit')
  	->name('dashboard.sections.edit')
    ->middleware(['permission:edit_sections']);

  	Route::put('{id}'		,'SectionController@update')
  	->name('dashboard.sections.update')
    ->middleware(['permission:edit_sections']);

  	Route::delete('{id}'	,'SectionController@destroy')
  	->name('dashboard.sections.destroy')
    ->middleware(['permission:delete_sections']);

  	Route::get('deletes'	,'SectionController@deletes')
  	->name('dashboard.sections.deletes')
    ->middleware(['permission:delete_sections']);

  	Route::get('{id}','SectionController@show')
  	->name('dashboard.sections.show')
    ->middleware(['permission:show_sections']);

});
