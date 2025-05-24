<?php

Route::group(['prefix' => 'notifications'], function () {

  	Route::get('/' ,'DeviceTokenController@index')
  	->name('dashboard.notifications.index')
    ->middleware(['permission:show_notifications']);

  	Route::post('/'			,'DeviceTokenController@send')
  	->name('dashboard.notifications.send')
    ->middleware(['permission:send_notifications']);

});
