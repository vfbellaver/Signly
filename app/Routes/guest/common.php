<?php

Route::get('share/{teamSlug}/{faceCode}', 'Web\BillboardsController@publicView')
    ->name('billboard.public-view');