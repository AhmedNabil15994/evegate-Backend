<?php
// reset password
Route::group(['prefix' => 'reset'], function ($router) {

    // Show Forget Password Form
    Route::get('{token}', 'ResetPasswordController@resetPassword')
    ->name('frontend.password.reset');
    // ->middleware('guest');

    // Send Forget Password Via Mail
    Route::post('/', 'ResetPasswordController@updatePassword')
    ->name('frontend.password.update');
});
