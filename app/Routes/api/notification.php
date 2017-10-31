<?php
Route::resource('notification', 'Api\NotificationsController',
    ['only' => ['index', 'update']]);