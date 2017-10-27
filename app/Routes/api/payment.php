<?php

Route::get('payment/get-card', 'Api\PaymentController@getCard')->name('payment.card');
Route::post('payment/create-token', 'Api\PaymentController@createToken')->name('payment.token');
Route::post('payment/card-update', 'Api\PaymentController@getToken')->name('payment.update.card');
Route::get('payment/update-subscription/{plan}', 'Api\PaymentController@updateSubscription')->name('payment.update.subscription');