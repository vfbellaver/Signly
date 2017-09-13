<?php

Route::post('image/upload', 'Api\FileUploadController@imageUpload')->name('image.upload');