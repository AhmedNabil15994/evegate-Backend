<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'sections'], function () {
    Route::get('/', 'SectionController@sections')->middleware('cacheResponse')->name('api.sections.index');

    Route::group(["prefix" => "{id}"], function () {
        // Route::get('/'   , 'SectionController@section')->name('api.sections.show');
    });
});
