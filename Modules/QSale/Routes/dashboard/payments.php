<?php

use Illuminate\Support\Facades\Route;

Route::get('/payments', 'PaymentsController@index')
    ->name('dashboard.payments.index')
    ->middleware(['permission:show_payments']);

Route::get('datatable', 'PaymentsController@datatable')
    ->name('dashboard.payments.datatable')
    ->middleware(['permission:show_payments']);
