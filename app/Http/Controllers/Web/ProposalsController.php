<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Proposal;

class ProposalsController extends Controller
{
    public function index()
    {
        return view('proposal.index');
    }

    public function show($id)
    {
        $user = auth()->user();
        $proposal = Proposal::query()
            ->where('id', $id)
            ->where('team_id', $user->team_id)
            ->firstOrFail();

        return view('proposal.show', ['proposal' => $proposal]);
    }
}
