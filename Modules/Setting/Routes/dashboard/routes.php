<?php

Route::group(['prefix' => 'setting'], function () {

    // Show Settings Form
    Route::get('/', 'SettingController@index')
    ->name('dashboard.setting.index')
    ->middleware(['permission:edit_settings']);

    // Update Settings
    Route::post('/', 'SettingController@update')
    ->name('dashboard.setting.update')
    ->middleware(['permission:edit_settings']);

});
