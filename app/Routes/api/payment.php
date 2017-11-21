<?php

Route::get('payment/get-card', 'Api\PaymentController@getCard')->name('payment.card');
Route::put('payment/card-update', 'Api\PaymentController@updateCard')->name('payment.update.card');
Route::delete('payment/card-subscription/{user}}', 'Api\PaymentController@deleteSubscription')->name('payment.delete.subscription');
Route::put('payment/update-subscription', 'Api\PaymentController@updateSubscription')->name('payment.update.subscription');
Route::get('payment/invoices/{invoice}','Api\PaymentController@invoices')->name('payment.invoices');