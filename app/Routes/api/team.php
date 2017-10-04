<?php

Route::resource('team', 'Api\TeamsController', ['except' => ['show', 'create', 'edit']]);