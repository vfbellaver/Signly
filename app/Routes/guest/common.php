<?php

Route::get('{teamSlug}/{faceCode}', 'Web\BillboardsController@publicView')
    ->name('billboard.public-view');

Route::get('proposal/share/{proposal}', 'Web\BillboardsController@publicView')
    ->name('proposal.public-view');
