<?php

use Illuminate\Support\Facades\Route;
// addations
Route::group(['prefix' => 'shipping_companies'], function () {
    Route::get('/', 'ShippingCompanyController@index');
    Route::get('/{id}', 'ShippingCompanyController@view');
});
