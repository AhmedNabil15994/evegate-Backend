<?php
// addations
Route::group(['prefix' => 'offers'], function () {
    Route::get('/', 'OfferController@index');
    Route::get('/{id}', 'OfferController@view');
});
