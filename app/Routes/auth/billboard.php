<?php

Route::resource('billboards', 'Web\BillboardsController', ['only' => ['index', 'edit','create','show']]);

Route::get('billboard-public/{team-name}/{billboard-name}',
    'Web\BillboardsController@publicPage')->name('public-page');

Route::post('billboard-public',
    'Web\BillboardsController@makePublicPage')->name('make-public-page');