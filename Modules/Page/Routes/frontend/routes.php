<?php

Route::group(['prefix' => 'p'], function () {

    Route::get('{slug}', 'PageController@page')->name('frontend.pages.index');

});
