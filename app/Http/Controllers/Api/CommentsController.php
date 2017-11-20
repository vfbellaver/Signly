<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use App\Services\CommentService;

class CommentsController extends Controller
{
    private $service;

    public function __construct(CommentService $service)
    {
        $this->middleware('needsRole:admin');
        $this->service = $service;
    }

    public function index()
    {
        return Comment::all();
    }

    public function store(CommentCreateRequest $request)
    {
        $data = $this->service->create($request->form());

        $response = [
            'message' => 'Comment created.',
            'data' => $data
        ];

        return $response;
    }

    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $obj = $this->service->update($request->form(), $comment);

        $response = [
            'message' => 'Comment updated.',
            'data' => $obj,
        ];

        return $response;
    }

    public function destroy(Comment $comment)
    {
        $this->service->delete($comment);

        return [
            'message' => 'Comment deleted.'
        ];
    }
}
