<?php

Route::get('face/{teamSlug}/{faceCode}', 'Web\BillboardsController@publicView')
    ->name('billboard.public-view');