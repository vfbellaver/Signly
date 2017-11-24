<?php

Route::resource('users', 'Web\UsersController', ['only' => ['index']]);
Route::get('user/settings', "Web\UsersController@settings")->name('user.settings');