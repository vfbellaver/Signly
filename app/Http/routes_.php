<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Main Home controller for login
Route::get('/', 'HomeController@index');

//Client
Route::get('/clients', 'ClientController@index');
Route::get('/clients/{id}', ['uses' => 'ClientController@get', function($id){}])->where('id', '[0-9]+');
Route::get('/add-client', 'ClientController@add');
Route::post('/post-client', ['as' => 'postclient', 'uses' => 'ClientController@store']);

//Billboard
Route::get('/billboards', 'BillboardController@index');
Route::get('/billboard-booking', 'BillboardController@billboardlist');
Route::get('/billboards/json', 'BillboardController@json');
Route::get('/billboard-faces/json/{id}', 'BillboardController@facesJson');

Route::get('/billboards/{id}', ['uses' => 'BillboardController@get', function($id){}])->where('id', '[0-9]+');
Route::get('/add-billboard', 'BillboardController@add');
Route::post('/post-billboard', ['as' => 'postbillboard', 'uses' => 'BillboardController@store']);
Route::post('/post-book-billboard', ['as' => 'postbookbillboard', 'uses' => 'BillboardController@book']);
Route::post('/post-billboard-face/{id}', ['as' => 'postbillboardface', 'uses' => 'BillboardController@addbillboardface']);
Route::get('/billboards/tooltip/{id}', 'BillboardController@tooltip');


//Proposal
Route::get('/proposals', 'ProposalController@index');
Route::get('/add-proposal', 'ProposalController@add');
Route::post('/post-proposal', ['as' => 'postproposal', 'uses' => 'ProposalController@store']);
Route::get('/active-proposal/remove-billboard/{id}', 'ProposalController@removebillboard');
Route::get('/active-proposal/add-billboard/{id}', 'ProposalController@addbillboard');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('images/billboard/{imageName}', function($imageName)
{
	$storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
	$filepath = $storagePath. 'images/' . $imageName;
	return Response::download($filepath);
});
