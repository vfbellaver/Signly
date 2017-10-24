<?php
Route::resource('message', 'Api\MessagesController',
    ['except' => ['create', 'edit','delete','store','show','destroy']]);