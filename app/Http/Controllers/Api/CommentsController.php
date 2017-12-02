<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function getNotVisualized($id)
    {
        $comment = Comment::query()
            ->where('proposal_id', '=', $id)
            ->where('visualized', '=', false)
            ->get()
            ->toArray();

        return $comment;

    }

    public function updateComments($proposalId)
    {
        Comment::query()->where('proposal_id', '=', $proposalId)
            ->update(['visualized' => true]);
        return 'updated';
    }
}
