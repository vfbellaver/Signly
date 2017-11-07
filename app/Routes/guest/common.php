<?php

Route::get('{teamSlug}/{billboardSlug}', 'Web\BillboardsController@publicView')
    ->name('billboard.public-view');