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

Route::get('/get-comments/{id}', ['uses' => 'HomeController@getComments']);
Route::get('/get-comments-client/{id}', ['uses' => 'HomeController@getCommentsClient']);

Route::get('register', 'Auth\AuthController@showRegistrationForm');
Route::post('register', 'Auth\AuthController@register');

Route::get('/instance-users/{hash}', ['uses' => 'HomeController@instanceUsers']);
Route::get('/instances', ['uses' => 'HomeController@instanceView']);
Route::get('/add-instance', 'HomeController@addInstance');
Route::post('/post-instance', ['as' => 'postinstance', 'uses' => 'HomeController@storeInstance']);
Route::get('/add-instance-user/{instanceId}', 'HomeController@addInstanceUser');
Route::post('/post-instance-user', ['as' => 'postinstanceuser', 'uses' => 'HomeController@storeInstanceUser']);
Route::post('/reoder-active-proposal', 'HomeController@sortable');

Route::post('/delete-instance-user/{id}',array('uses' => 'HomeController@deleteOwner', 'as' => 'deleteuser'));

//Main Home controller for login
Route::get('/clientview/{hash}', ['uses' => 'ClientviewController@clientView']);
Route::get('/clientview/accept/{pid}/{id}', ['uses' => 'ClientviewController@clientAccepted']);
Route::get('/clientview/reject/{pid}/{id}', ['uses' => 'ClientviewController@clientRejected']);
Route::get('/clientview/jsonhash/{hash}', 'ClientviewController@jsonHash');
Route::get('/clientview/acceptproposal/{id}', 'ClientviewController@clientAcceptProposal');
Route::post('/clientview/generate-pdf-proposal', ['uses' => 'ClientviewController@pdfProposal']);

Route::post('/post-proposal-billboard-comment-client', ['as' => 'postproposalcommentclient', 'uses' => 'ClientviewController@addComment']);


Route::get('/', 'HomeController@redirectToDashbaord');
Route::get('/dashboard', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('/home', function(){
	return Redirect::to('/dashboard');
});

Route::post('/dateset', ['as' => 'filterBillboard', 'uses' => 'HomeController@indexFilter']);

Route::get('/account', 'HomeController@account');
Route::post('/post-user-update', ['as' => 'postuserupdate', 'uses' => 'HomeController@updateUser']);

//Owner
Route::get('/owners', 'OwnerController@index');
Route::get('/owners/{id}', ['uses' => 'OwnerController@get', function($id){}])->where('id', '[0-9]+');
Route::get('/add-owner', 'OwnerController@add');
Route::post('/post-owner', ['as' => 'postowner', 'uses' => 'OwnerController@store']);
Route::post('/owners/delete/{id}',array('uses' => 'OwnerController@deleteOwner', 'as' => 'deleteowner'));

//Client
Route::get('/clients', 'ClientController@index');
Route::get('/clients/{id}', ['uses' => 'ClientController@get', function($id){}])->where('id', '[0-9]+');
Route::get('/add-client', 'ClientController@add');
Route::post('/post-client', ['as' => 'postclient', 'uses' => 'ClientController@store']);
Route::post('/clients/delete/{id}',array('uses' => 'ClientController@deleteClient', 'as' => 'deleteclient'));

//Billboard
Route::get('/billboards', 'BillboardController@index');
Route::get('/billboard-booking', 'BillboardController@billboardlist');
Route::get('/billboard-booking-vendor', 'BillboardController@billboardlistbyvendor');
Route::post('/billboard-booking/delete/{id}',array('uses' => 'BillboardController@deleteBooking', 'as' => 'deletebillboardbooking'));

Route::get('/billboards/json', 'BillboardController@json');
Route::get('/billboards/jsonhash/{hash}', 'BillboardController@jsonHash');
Route::get('/billboard-faces/json/{id}', 'BillboardController@facesJson');
Route::get('/billboard-face/json/{id}', 'BillboardController@faceJson');
Route::get('/billboards/daypilot/json', 'BillboardController@jsonDaypilot');
Route::post('/billboards/daypilotevents/json', 'BillboardController@jsonDaypilotEvents');
Route::post('/billboards/search', 'BillboardController@searchBillboard');

Route::get('/billboards/{id}', ['uses' => 'BillboardController@get', function($id){}])->where('id', '[0-9]+');
Route::get('/add-billboard', 'BillboardController@add');
Route::post('/post-billboard', ['as' => 'postbillboard', 'uses' => 'BillboardController@store']);
Route::post('/post-book-billboard', ['as' => 'postbookbillboard', 'uses' => 'BillboardController@book']);
Route::post('/post-billboard-face/{id}', ['as' => 'postbillboardface', 'uses' => 'BillboardController@addbillboardface']);
Route::post('/post-billboard-face-update/{id}', ['as' => 'postbillboardfaceupdate', 'uses' => 'BillboardController@updatebillboardface']);
Route::get('/billboards/tooltip/{id}', 'BillboardController@tooltip');
Route::delete('/billboard/delete/{id}',array('uses' => 'BillboardController@destroy', 'as' => 'deletebillboard'));

//Proposal
Route::get('/proposals', 'ProposalController@index');

Route::get('/proposal-signature', 'ProposalController@proposalForm');
Route::get('/proposals/book/{id}', 'ProposalController@bookProposal');



Route::get('/add-proposal', 'ProposalController@add');
Route::get('/edit-proposal-billboards/{id}', 'ProposalController@edit');
Route::post('/post-proposal', ['as' => 'postproposal', 'uses' => 'ProposalController@store']);
Route::get('/active-proposal/remove-billboard/{id}', 'ProposalController@removebillboard');
Route::get('/active-proposal/add-billboard/{id}/{faceid}', 'ProposalController@addbillboard');


Route::post('/save-active-proposal-billboards', ['as' => 'postproposalbillboards', 'uses' => 'ProposalController@saveProposalBillbaord']);
Route::post('/send-active-proposal', ['as' => 'sendproposal', 'uses' => 'ProposalController@sendProposal']);
Route::post('/copy-active-proposal', ['as' => 'copyproposal', 'uses' => 'ProposalController@copyLink']);
Route::post('/generate-pdf-proposal', ['as' => 'pdfproposal', 'uses' => 'ProposalController@pdfProposal']);
Route::post('/generate-print-proposal', ['as' => 'printproposal', 'uses' => 'ProposalController@printProposal']);
Route::post('/post-proposal-billboard', ['as' => 'postproposalbillboard', 'uses' => 'ProposalController@addbillboard']);

Route::post('/post-proposal-billboard-comment', ['as' => 'postproposalcomment', 'uses' => 'ProposalController@addComment']);

Route::get('/proposal/make-contract/{id}', 'ProposalController@proposalSignature');
Route::post('/post-proposal-contract', ['as' => 'postproposalcontract', 'uses' => 'ProposalController@signContract']);

Route::delete('/proposal/delete/{id}',array('uses' => 'ProposalController@destroy', 'as' => 'deleteproposal'));

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('images/billboard/{imageName}', function($imageName){
	$storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
	$filepath = $storagePath. 'images/' . $imageName;
	return Response::download($filepath);
});

Route::get('/proposals', 'ProposalController@index');

Route::get('/billboard-upload', 'BillboardController@getUploadBillboard');
Route::post('/save-upload-billboards', ['as' => 'postbillboarduploads', 'uses' => 'BillboardController@saveUploadBillbaord']);

Route::post('/send-bug-report', ['as' => 'postbugreport', 'uses' => 'HomeController@sendBugReport']);
