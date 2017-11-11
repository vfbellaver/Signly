<?php

Route::get('payment/get-card', 'Api\PaymentController@getCard')->name('payment.card');
Route::post('payment/card-update', 'Api\PaymentController@updateCard')->name('payment.update.card');
Route::delete('payment/card-subscription/{user}}', 'Api\PaymentController@deleteSubscription')->name('payment.delete.subscription');
Route::get('payment/update-subscription/{plan}', 'Api\PaymentController@updateSubscription')->name('payment.update.subscription');
Route::get('payment/invoices','Api\PaymentController@invoices')->name('payment.invoices');