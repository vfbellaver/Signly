<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function getNotVisualized($id)
    {

        $comment = Comment::query()->where('proposal_id','=',$id)->where('visualized','=',false)
            ->get()->toArray();

        return $comment;

    }

    public function updateComments(Request $request)
    {

        Comment::query()->where('proposal_id', '=', $request->input('id'))
            ->update(['visualized' => true]);

        return 'ok';
    }
}
