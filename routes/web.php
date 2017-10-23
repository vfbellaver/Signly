<?php
Route::get('demo', function () {
    return view('demo');
});

Route::get('stripe', function () {
    return '';
});

Route::get('payment', 'Web\\PaymentController@index')->name('payment');
Route::post('payment', 'Web\\PaymentController@store')->name('pay');
//Route::post('payment-plan', 'Web\\PaymentController@termsAccept')->name('register.plan');
Route::get('payment/{plan}', 'Web\\PaymentController@registerUser')->name('register.plan');

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


Route::get('/ ','Web\HomeController@index');
Route::get('billboards/public','Api\PublicBillboardsController@index')
    ->name('billboards.public');
Route::get('team/billboard/{id}','Api\PublicBillboardsController@getTeam')
    ->name('billboard.team');

Route::get('{teamName}/{billboardName}', 'Api\PublicBillboardsController@showDetails')
    ->name('billboard.details');

Route::get('slc.js', function () {
    $json = json_encode(array_merge(Slc::scriptVariables(), []));
    $js = <<<js
window.Slc = {$json};
js;
    return response($js)->header('Content-Type', 'text/javascript');
})->name('slc.js');

foreach (File::files(app()->path() . '/Routes/guest') as $file) {
    require $file;
}

Route::group(['middleware' => ['auth']], function () {
    foreach (File::files(app()->path() . '/Routes/auth') as $file) {
        require $file;
    }
});



