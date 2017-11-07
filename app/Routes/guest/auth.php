<?php

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('register', 'Auth\RegisterController@register')->name('register');
Route::post('register', 'Auth\RegisterController@registerPost')->name('register-post');
Route::post('register/invitation', 'Auth\RegisterController@registerInvitation')->name('register-invitation');
Route::get('register/invitation/{token}', 'Auth\RegisterController@invitation')->name('invitation');
Route::get('terms-of-service', 'Auth\RegisterController@termsOfService')->name('terms-of-service');