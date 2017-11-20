<?php

Route::get('{teamSlug}/{faceCode}', 'Web\BillboardsController@publicView')
    ->name('billboard.public-view');