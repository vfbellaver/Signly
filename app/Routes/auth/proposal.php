<?php

Route::resource('proposals', 'Web\ProposalsController', ['only' => ['index']]);