<?php

Route::resource('billboards', 'Web\BillboardsController', ['only' => ['index', 'edit','create','show']]);
