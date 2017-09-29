<?php

Route::post('csv/upload', 'Api\BillboardsCsvController@CsvConvertArray')->name('csv.upload');
Route::resource('csv', 'Api\BillboardsCsvController', ['except' => ['show', 'create', 'edit','update','destroy']]);
//Route::post('csv/save', 'Api\BillboardsCsvController@SaveBillboardsCsv')->name('csv.save');
