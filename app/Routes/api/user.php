<?php

Route::resource('user', 'Api\UsersController', ['except' => ['show', 'create', 'edit']]);
Route::get('current-user', 'Api\CurrentUserController')->name('current.user');

Route::put('user/{user}/photo', 'Api\UsersController@updatePhoto')->name('user.update.photo');
Route::put('user/{user}/password', 'Api\UsersController@updatePassword')->name('user.update.password');
Route::put('user/{user}/billing', 'Api\UsersController@updateBilling')->name('user.update.billing');