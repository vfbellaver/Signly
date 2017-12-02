<?php

Route::get('share/{teamSlug}/{faceCode}', 'Web\BillboardsController@publicView')
    ->name('billboard.public-view');

Route::get('terms-of-service', function () {
    return view('auth.terms-of-service');
})->name('terms-of-service');

Route::get('privacy-policy', function () {
    return view('auth.privacy-policy');
})->name('privacy-policy');