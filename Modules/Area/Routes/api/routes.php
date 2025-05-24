<?php

Route::group(['prefix' => 'areas'], function () {
    Route::get('cities', 'AreaController@cities')
        ->middleware('cacheResponse')->name('api.areas.cities');
    Route::get('countries', 'AreaController@countries')
        ->middleware('cacheResponse')
        ->name('api.areas.countries');
    Route::get('cities/{id}/states', 'AreaController@states')
        ->middleware('cacheResponse')
        ->name('api.areas.states');
});
