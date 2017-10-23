<?php
Route::get('demo', function () {
    return view('demo');
});

Route::get('stripe', function () {
    return '';
});

Route::get('payment', 'Web\PaymentController@index')->name('payment');
Route::post('payment', 'Web\PaymentController@store')->name('pay');
Route::get('payment/{plan}', 'Web\PaymentController@registerUser')->name('register.plan');
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

// Routes Public Page
Route::get('billboards/public','Api\PublicBillboardsController@index')
    ->name('public.billboard.page');
Route::get('team/billboard/{id}','Api\PublicBillboardsController@makeUrl')
    ->name('make.url');
Route::get('{teamName}/{billboardName}', 'Api\PublicBillboardsController@showDetails')
    ->name('public.billboard.details');
Route::get('public/get/{billboard}','Api\PublicBillboardsController@getBillboard')
    ->name('public.get.billboard');
Route::get('public/faces/{bid}','Api\PublicBillboardsController@getFaces')
    ->name('public.get.faces');

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




