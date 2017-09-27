<?php

Route::resource('csv-upload', 'Web\BillboardsCsvController', ['only' => ['index']]);
