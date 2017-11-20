<?php

Route::resource('comment', 'Web\CommentsController', ['only' => ['store']]);