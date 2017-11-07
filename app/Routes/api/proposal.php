<?php

Route::resource('proposal', 'Api\ProposalsController', ['except' => ['create', 'edit']]);