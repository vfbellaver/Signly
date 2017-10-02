<?php

Route::resource('billboard', 'Api\BillboardsController',
    ['except' => ['create', 'edit']]);