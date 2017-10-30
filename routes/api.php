<?php

use Illuminate\Http\Request;

Route::group(['as' => 'api.', 'middleware' => ['auth:api']], function () {

    foreach (File::files(app()->path() . '/Routes/api') as $file) {
        require $file;
    }

});

Route::post('payment/user-verify', 'Api\PaymentController@verify')->name('api.payment.verify.user');
Route::post('payment/user-pay', 'Api\PaymentController@store')->name('api.payment.user.pay');
Route::post('payment/create-token', 'Api\PaymentController@createToken')->name('api.payment.token');