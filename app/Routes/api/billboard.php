<?php

Route::resource('billboard', 'Api\BillboardsController',
    ['except' => ['show', 'create', 'edit']]);