<?php

namespace App\Forms;

use App\Models\Team;

class UserForm extends BaseForm
{
    public function name()
    {
        return $this->request->get('name');
    }

    public function photo_url()
    {
        return $this->request->get('photo_url');
    }

    public function email()
    {
        return $this->request->get('email');
    }

    public function password()
    {
        return $this->request->get('password');
    }

    public function role()
    {
        if (!$this->request->has('role')) return null;

        $role = (object)$this->request->get('role');
        return \Defender::findRoleById($role->id);
    }

    public function team()
    {
        if (!$this->request->has('team')) {
            return null;
        }
        $team = (object)$this->request->get('team');
        return Team::query()->findOrFail($team->id);
    }
}
