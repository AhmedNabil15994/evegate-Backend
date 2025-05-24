<?php
Route::group(['prefix' => 'questions'], function () {

   Route::get("/", "QuestionController@index");

   

});