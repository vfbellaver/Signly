<?php

Route::resource('proposal', 'Api\ProposalsController', ['except' => ['create', 'edit']]);

Route::post('proposal/{proposal}', 'Api\ProposalsController@addBillboardFace')->name('proposal.add-billboard-face');