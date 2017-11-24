<?php

Route::get('comments/get-not-visualized/{id}',
    'Api\CommentsController@getNotVisualized')
    ->name('comments.get.not.visualized')->where(['id' => '[0-9]']);


Route::put('comments/update-comments',
    'Api\CommentsController@updateComments')
    ->name('update.comments');