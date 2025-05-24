<?php

Route::group(['prefix' => 'questions'], function () {

  	Route::get('/' ,'QuestionController@index')
  	->name('dashboard.questions.index')
    ->middleware(['permission:show_questions']);

  	Route::get('datatable'	,'QuestionController@datatable')
  	->name('dashboard.questions.datatable')
  	->middleware(['permission:show_questions']);

  	Route::get('create'		,'QuestionController@create')
  	->name('dashboard.questions.create')
    ->middleware(['permission:add_questions']);

  	Route::post('/'			,'QuestionController@store')
  	->name('dashboard.questions.store')
    ->middleware(['permission:add_questions']);

  	Route::get('{id}/edit'	,'QuestionController@edit')
  	->name('dashboard.questions.edit')
    ->middleware(['permission:edit_questions']);

  	Route::put('{id}'		,'QuestionController@update')
  	->name('dashboard.questions.update')
    ->middleware(['permission:edit_questions']);

  	Route::delete('{id}'	,'QuestionController@destroy')
  	->name('dashboard.questions.destroy')
    ->middleware(['permission:delete_questions']);

  	Route::get('deletes'	,'QuestionController@deletes')
  	->name('dashboard.questions.deletes')
    ->middleware(['permission:delete_questions']);

  
	
	

});
