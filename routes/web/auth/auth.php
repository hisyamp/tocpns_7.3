<?php
Route::get('/', 'auth\LoginController@formlogin')->name('login');;
Route::post('/postlogin', 'auth\LoginController@postLogin');
Route::get('/logout', 'auth\LoginController@logout')->name('logout');
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::post('/regis', 'auth\RegisterController@regis')->name('register');
