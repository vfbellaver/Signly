<?php

Route::resource('client', 'Api\ClientsController', ['except' => ['create', 'edit']]);