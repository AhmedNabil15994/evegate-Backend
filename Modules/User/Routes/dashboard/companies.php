<?php

Route::group(['prefix' => 'companies'], function () {
    Route::get('/', 'CompanyController@index')
    ->name('dashboard.companies.index')
    ->middleware(['permission:show_companies']);

    Route::get('datatable', 'CompanyController@datatable')
    ->name('dashboard.companies.datatable')
    ->middleware(['permission:show_companies']);

    Route::get('create', 'CompanyController@create')
    ->name('dashboard.companies.create')
    ->middleware(['permission:add_companies']);

    Route::get('list-select', 'CompanyController@listSelect2')
    ->name('dashboard.companies.list_select')
    ->middleware(['permission:add_companies']);

    Route::post('/', 'CompanyController@store')
    ->name('dashboard.companies.store')
    ->middleware(['permission:add_companies']);

    Route::get('{id}/edit', 'CompanyController@edit')
    ->name('dashboard.companies.edit')
    ->middleware(['permission:edit_companies']);

    Route::put('{id}', 'CompanyController@update')
    ->name('dashboard.companies.update')
    ->middleware(['permission:edit_companies']);

    Route::delete('{id}', 'CompanyController@destroy')
    ->name('dashboard.companies.destroy')
    ->middleware(['permission:delete_companies']);

    Route::get('deletes', 'CompanyController@deletes')
    ->name('dashboard.companies.deletes')
    ->middleware(['permission:delete_companies']);

    Route::get('{id}', 'CompanyController@show')
    ->name('dashboard.companies.show')
    ->middleware(['permission:show_companies']);

    Route::post('{id}/renwal', 'CompanyController@renwal')
    ->name('dashboard.companies.renwal')
    ->middleware(['permission:edit_companies']);
});

