<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'shipping_companies'], function () {

  Route::get('/', 'ShippingCompanyController@index')
    ->name('dashboard.shipping_companies.index')
    ->middleware(['permission:show_shipping_companies']);
  Route::get('datatable', 'ShippingCompanyController@datatable')
    ->name('dashboard.shipping_companies.datatable')
    ->middleware(['permission:show_shipping_companies']);
  Route::get('create', 'ShippingCompanyController@create')
    ->name('dashboard.shipping_companies.create')
    ->middleware(['permission:add_shipping_companies']);

  Route::post('/', 'ShippingCompanyController@store')
    ->name('dashboard.shipping_companies.store')
    ->middleware(['permission:add_shipping_companies']);

  Route::get('{id}/edit', 'ShippingCompanyController@edit')
    ->name('dashboard.shipping_companies.edit')
    ->middleware(['permission:edit_shipping_companies']);

  Route::put('{id}', 'ShippingCompanyController@update')
    ->name('dashboard.shipping_companies.update')
    ->middleware(['permission:edit_shipping_companies']);

  Route::delete('{id}', 'ShippingCompanyController@destroy')
    ->name('dashboard.shipping_companies.destroy')
    ->middleware(['permission:delete_shipping_companies']);

  Route::get('deletes', 'ShippingCompanyController@deletes')
    ->name('dashboard.shipping_companies.deletes')
    ->middleware(['permission:delete_shipping_companies']);

  Route::get('{id}', 'ShippingCompanyController@show')
    ->name('dashboard.shipping_companies.show')
    ->middleware(['permission:show_shipping_companies']);
});
