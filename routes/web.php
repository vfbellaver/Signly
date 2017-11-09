<?php

Route::get('roles', function () {
    $roles = Defender::rolesList();

    $roles = $roles->map(function ($name, $id) {
        return [
            'id' => $id,
            'name' => $name
        ];
    });

    dd($roles);
});

Route::get('pdf','Web\PDFController@index');

Route::get('slc.js', function () {
    $json = json_encode(array_merge(Slc::scriptVariables(), []));
    $js = <<<js
window.Slc = {$json};
js;
    return response($js)->header('Content-Type', 'text/javascript');
})->name('slc.js');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/ ', 'Web\HomeController@index')->name('home');

    foreach (File::files(app()->path() . '/Routes/auth') as $file) {
        require $file;
    }
});

foreach (File::files(app()->path() . '/Routes/guest') as $file) {
    require $file;
}
