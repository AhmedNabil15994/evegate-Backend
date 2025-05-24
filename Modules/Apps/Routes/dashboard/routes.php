<?php


Route::group(['prefix' => '/' , 'middleware' => ['dashboard.auth','permission:dashboard_access']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.home');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});

// ================================ contact us ===========================

Route::group(['prefix' => 'contacts'], function () {
    Route::get('/', 'ContactController@index')
    ->name('dashboard.contact.index')
    ->middleware(['permission:show_contact']);

    Route::get('datatable', 'ContactController@datatable')
    ->name('dashboard.contact.datatable')
    ->middleware(['permission:show_contact']);

  

    Route::delete('{id}', 'ContactController@destroy')
    ->name('dashboard.contact.destroy')
    ->middleware(['permission:delete_contact']);

    Route::get('deletes', 'ContactController@deletes')
    ->name('dashboard.contact.deletes')
    ->middleware(['permission:delete_contact']);
});
