<?php

Route::get('payment/get-card', 'Api\PaymentController@getCard')->name('payment.card');
Route::post('payment/card-update', 'Api\PaymentController@updateCard')->name('payment.update.card');
Route::get('payment/card-delete', 'Api\PaymentController@deleteSubscription')->name('payment.delete.card');
Route::get('payment/update-subscription/{plan}', 'Api\PaymentController@updateSubscription')->name('payment.update.subscription');