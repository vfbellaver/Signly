<?php

Route::get('comments/get-not-visualized/{id}',
    'Api\CommentsController@getNotVisualized')
    ->name('comments.get.not.visualized');


Route::put('comments/update-comments/{proposal}',
    'Api\CommentsController@updateComments')
    ->name('update.comments');