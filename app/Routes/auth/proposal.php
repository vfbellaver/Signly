<?php

Route::resource('proposals', 'Web\ProposalsController', ['only' => ['index', 'show']]);

Route::get('proposal/pdf/{proposal}', 'Web\ProposalsController@pdf')->name('proposal.pdf');