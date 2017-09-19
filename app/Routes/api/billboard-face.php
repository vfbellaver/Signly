<?php


Route::resource('billboard-face', 'Api\BillboardFacesController',
    ['except' => ['show', 'create', 'edit']]);
