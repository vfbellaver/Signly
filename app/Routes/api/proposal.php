<?php

Route::resource('proposal', 'Api\ProposalsController', ['except' => ['create', 'edit']]);

Route::post('proposal/add-billboard-face', 'Api\ProposalsController@createProposalBillboardFace')
    ->name('proposal.create-billboard-face');

Route::put('proposal/update-billboard-face/{face}', 'Api\ProposalsController@updateProposalBillboardFace')
    ->name('proposal.update-billboard-face');

Route::put('proposal/{proposal}/reorder-billboard-faces', 'Api\ProposalsController@reorderProposalBillboardFaces')
    ->name('proposal.reorder-billboard-faces');

Route::delete('proposal/{proposal}/destroy-billboard-face/{face}', 'Api\ProposalsController@destroyProposalBillboardFace')
    ->name('proposal.destroy-billboard-face');