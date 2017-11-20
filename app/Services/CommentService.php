<?php

namespace App\Services;

use App\Events\CommentCreated;
use App\Events\CommentDeleted;
use App\Events\CommentUpdated;
use App\Forms\CommentForm;
use App\Models\Comment;

class CommentService
{
    public function create(CommentForm $form): Comment
    {
        return \DB::transaction(function () use ($form) {
            $data = [
                'from_name' => $form->fromName(),
                'comment' => $form->comment(),
            ];

            $comment = new Comment($data);
            $comment->billboardFace()->associate($form->billboard_face());
            $comment->team()->associate($form->team());
            if ($form->user()) {
                $comment->user()->associate($form->user());
            }

            $comment->save();

            event(new CommentCreated($comment));

            return $comment;
        });
    }

    public function update(CommentForm $form, Comment $comment): Comment
    {
        return \DB::transaction(function () use ($form, $comment) {
            $comment->from_name = $form->fromName();
            $comment->comment = $form->comment();
            $comment->team()->associate($form->team());
            $comment->billboardFace()->associate($form->billboard_face());
            if ($form->user()) {
                $comment->user()->associate($form->user());
            }

            $comment->save();

            event(new CommentUpdated($comment));

            return $comment;
        });
    }

    public function delete(Comment $comment)
    {
        return \DB::transaction(function () use ($comment) {
            $comment->delete();

            event(new CommentDeleted($comment));
        });
    }
}
