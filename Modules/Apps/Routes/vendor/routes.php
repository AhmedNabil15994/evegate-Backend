<?php

Route::group(['prefix' => '/' , 'middleware' => ['vendor.auth','permission:worker_access']], function() {
    Route::get('/' , 'VendorController@index')->name('vendor.home');
    Route::get('/edit-vendor-info/{id}' , 'VendorController@editVendorInfo')
                ->name('vendor.edit.info')
                ->middleware(['permission:edit_vendors']);
    Route::put('/update-vendor-info/{id}' , 'VendorController@updateVendorInfo')->name('vendor.update.info')
        ->middleware(['permission:edit_vendors']);

});
