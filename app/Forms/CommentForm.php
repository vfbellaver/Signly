<?php

namespace App\Forms;

use App\Models\Proposal;

class CommentForm extends BaseForm
{
    public function team()
    {
        return $this->proposal()->team;
    }

    public function proposal()
    {
        $proposal = $this->request->get('proposal');
        return Proposal::query()->findOrFail($proposal['id']);
    }

    public function user()
    {
        if (auth()->check()) {
            return auth()->user();
        }

        return null;
    }

    public function fromName()
    {
        return $this->request->get('from_name');
    }

    public function comment()
    {
        return $this->request->get('comment');
    }
}
