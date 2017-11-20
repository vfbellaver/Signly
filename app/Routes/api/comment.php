<?php

Route::resource('comment', 'Api\CommentsController', ['except' => ['show', 'create', 'edit']]);