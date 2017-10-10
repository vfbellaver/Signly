<?php

Route::resource('client', 'Api\ClientsController', ['except' => ['create', 'edit']]);

Route::post('client/csv-upload', 'Api\ClientsController@csvUpload')
    ->name('client.csv-upload');

Route::post('client/import', 'Api\ClientsController@import')
    ->name('client.import');