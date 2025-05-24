<?php



Route::get('/',"HomeController@index")->name("frontend.home");

// contact us
Route::get('/contact-us', 'HomeController@contactUs')->name('frontend.contact_us');
Route::post('/contact-us', 'HomeController@sendContactUs')->name('frontend.send-contact-us');