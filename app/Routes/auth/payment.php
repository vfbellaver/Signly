<?php

Route::get('payment/invoice/{invoice}','Web\PaymentController@invoicePDF')->name('payment.invoice.pdf');
