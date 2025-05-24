<?php

Route::group(['prefix' => 'device-tokens'], function () {

    Route::post('/'      , 'DeviceTokenController@create');

});
