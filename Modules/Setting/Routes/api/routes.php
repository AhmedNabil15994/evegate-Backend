<?php

Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'SettingController@settings')
    ->middleware('cacheResponse')
    ->name('api.settings.index');
    Route::get('/countries-code', 'SettingController@countries')
    ->middleware('cacheResponse')
    ->name('api.settings.index');
    Route::get('currency/{code}', 'SettingController@convertCurrency')
    ->name('api.convert.currency');
    Route::get('langues', 'SettingController@langues')
    ->middleware('cacheResponse')
    ->name('api.langues');
});
