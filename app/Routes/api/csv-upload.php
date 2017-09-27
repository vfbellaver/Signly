<?php

Route::post('csv/upload', 'Api\BillboardsCsvController@CsvConvertArray')->name('csv.upload');
Route::post('csv/save', 'Api\BillboardsCsvController@SaveBillboardsCsv')->name('csv.save');