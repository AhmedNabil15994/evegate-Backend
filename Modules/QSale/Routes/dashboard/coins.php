<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'coins'], function () {

  	Route::get('/' ,'CoinController@index')
  	->name('dashboard.coins.index')
    ->middleware(['permission:show_coins']);

  	Route::get('datatable'	,'CoinController@datatable')
  	->name('dashboard.coins.datatable')
  	->middleware(['permission:show_coins']);

  	Route::get('{id}/edit'	,'CoinController@edit')
  	->name('dashboard.coins.edit')
    ->middleware(['permission:edit_coins']);

  	Route::put('{id}'		,'CoinController@update')
  	->name('dashboard.coins.update')
    ->middleware(['permission:edit_coins']);


  	Route::get('{id}','CoinController@show')
  	->name('dashboard.coins.show')
    ->middleware(['permission:show_coins']);

});

Route::group(['prefix' => 'coins_transactions'], function () {

  	Route::get('/' ,'CoinController@coinsTransactionsIndex')
  	->name('dashboard.coins_transactions.index')
    ->middleware(['permission:show_coins']);

  	Route::get('datatable'	,'CoinController@coinsTransactionsDatatable')
  	->name('dashboard.coins_transactions.datatable')
  	->middleware(['permission:show_coins']);

});