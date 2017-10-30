<?php

namespace App\Forms;

class TeamForm extends BaseForm
{
    public function name()
    {
        return $this->request->get('name');
    }

    public function slug()
    {
        return $this->request->get('slug');
    }
}
