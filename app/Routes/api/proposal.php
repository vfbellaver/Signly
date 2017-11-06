<?php

Route::resource('proposal', 'Api\ProposalsController', ['except' => ['show', 'create', 'edit']]);