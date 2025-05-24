<?php

// ============================== attributes ========================
// attributes
Route::group(['prefix' => 'attributes'], function () {

    //global api
    Route::get("/", "AttributeController@index")->name("api.attributes")
        // ->middleware('cacheResponse')
    ;
});
