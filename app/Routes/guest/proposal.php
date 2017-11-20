<?php

Route::resource('public.api.proposal', 'Api\ProposalsController', ['only' => ['index', 'edit']]);

Route::get('public/api/proposal/{proposal}', 'Api\ProposalsController@publicShow')
    ->name('public.api.proposal.show');

Route::get('public/api/proposal/{proposal}/billboards', 'Api\ProposalsController@publicProposalBillboards')
    ->name('public.api.proposal.billboards');

Route::get('proposal/share/{proposal}', 'Web\ProposalsController@share')
    ->name('proposal.share');

Route::get('proposal/share/pdf/{proposal}', 'Web\ProposalsController@publicPdf')
    ->name('proposal.share.pdf');