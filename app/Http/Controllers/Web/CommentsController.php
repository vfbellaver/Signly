<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\Proposal;
use App\Services\CommentService;

class CommentsController extends Controller
{
    private $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    public function store(CommentCreateRequest $request)
    {
        $data = $this->service->create($request->form());

        return $data;
    }

    public function index()
    {
        $proposalEncryptedId = request()->get('proposal');
        $id = (int)decrypt($proposalEncryptedId);
        /** @var Proposal $proposal */
        $proposal = Proposal::query()->findOrFail($id);

        return $proposal->comments;
    }
}
