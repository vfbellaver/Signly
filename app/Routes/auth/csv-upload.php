<?php

Route::resource('csv-upload', 'Web\CsvUploadController', ['only' => ['index']]);