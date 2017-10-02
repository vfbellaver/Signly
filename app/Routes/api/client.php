<?php

Route::resource('client', 'Api\ClientsController', ['except' => ['show', 'create', 'edit']]);