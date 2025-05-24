<?php

Route::group(['prefix' => 'technicals'], function () {
    Route::get('/', 'TechnicalController@index')
    ->name('dashboard.technicals.index')
    ->middleware(['permission:show_technicals']);

    Route::get('datatable', 'TechnicalController@datatable')
    ->name('dashboard.technicals.datatable')
    ->middleware(['permission:show_technicals']);

    Route::get('create', 'TechnicalController@create')
    ->name('dashboard.technicals.create')
    ->middleware(['permission:add_technicals']);

    Route::get('list-select', 'TechnicalController@listSelect2')
    ->name('dashboard.technicals.list_select')
    ->middleware(['permission:add_technicals']);

    Route::post('/', 'TechnicalController@store')
    ->name('dashboard.technicals.store')
    ->middleware(['permission:add_technicals']);

    Route::get('{id}/edit', 'TechnicalController@edit')
    ->name('dashboard.technicals.edit')
    ->middleware(['permission:edit_technicals']);

    Route::put('{id}', 'TechnicalController@update')
    ->name('dashboard.technicals.update')
    ->middleware(['permission:edit_technicals']);

    Route::delete('{id}', 'TechnicalController@destroy')
    ->name('dashboard.technicals.destroy')
    ->middleware(['permission:delete_technicals']);

    Route::get('deletes', 'TechnicalController@deletes')
    ->name('dashboard.technicals.deletes')
    ->middleware(['permission:delete_technicals']);

    Route::get('{id}', 'TechnicalController@show')
    ->name('dashboard.technicals.show')
    ->middleware(['permission:show_technicals']);

    Route::post('{id}/renwal', 'TechnicalController@renwal')
    ->name('dashboard.technicals.renwal')
    ->middleware(['permission:edit_technicals']);
});

