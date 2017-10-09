<?php

Route::resource('billboard', 'Api\BillboardsController',
    ['except' => ['create', 'edit']]);

Route::post('billboard/csv-upload', 'Api\BillboardsController@csvUpload')
    ->name('billboard.csv-upload');

Route::post('billboard/import-billboard', 'Api\BillboardsController@import')
    ->name('billboard.import');