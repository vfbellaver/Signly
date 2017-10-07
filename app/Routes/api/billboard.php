<?php

Route::resource('billboard', 'Api\BillboardsController',
    ['except' => ['create', 'edit']]);

Route::post('billboard/csv-upload', 'Api\BillboardsController@csvUpload')
    ->name('billboard.csv-upload');