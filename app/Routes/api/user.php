<?php

Route::resource('user', 'Api\UsersController', ['except' => ['show', 'create', 'edit']]);
Route::get('current-user', 'Api\CurrentUserController')->name('current.user');
Route::get('user/get-timezone/{lat}/{lng}/{time}', 'Api\UsersController@getTimeZone')->name('user.get.timezone');
Route::put('user/{user}/photo', 'Api\UsersController@updatePhoto')->name('user.update.photo');
Route::put('user/{user}/password', 'Api\UsersController@updatePassword')->name('user.update.password');
Route::put('user/{user}/address', 'Api\UsersController@updateAddress')->name('user.update.address');
Route::put('user/{user}/location', 'Api\UsersController@updateLocation')->name('user.update.location');
Route::put('user/{user}/card', 'Api\UsersController@getToken')->name('user.update.card');
Route::put('user/{user}/plan', 'Api\UsersController@updatePlan')->name('user.update.plan');
Route::put('user/{user}/cancel-subscription', 'Api\UsersController@cancelSubscription')
    ->name('user.update.cancel-subscription');