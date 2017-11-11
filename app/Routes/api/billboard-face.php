<?php


Route::resource('billboard-face', 'Api\BillboardFacesController',
    ['except' => ['show', 'create', 'edit']]);

Route::get('billboard-face/search', 'Api\BillboardFacesController@search')->name('billboard-face.search');