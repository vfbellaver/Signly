<?php

namespace App\Forms;

use App\Models\Team;
use App\Models\User;

class BillboardForm extends BaseForm
{
	public function name()
	{
		return $this->request->get('name');
	}

	public function description()
	{
		return $this->request->get('description');
	}

	public function address()
	{
		return $this->request->get('address');
	}

	public function lat()
	{
		return $this->request->get('lat');
	}

	public function lng()
	{
		return $this->request->get('lng');
	}

    public function heading()
    {
        return $this->request->get('heading');
    }

    public function pitch()
    {
        return $this->request->get('pitch');
    }

    public function zoom()
    {
        return $this->request->get('zoom');
    }

    public function pano()
    {
        return $this->request->get('pano');
    }

    public function user()
    {
        $user = $this->request->get('user');
        return User::query()->findOrFail($user);
    }

    public function team()
    {
        $team = $this->request->get('team');
        return Team::query()->findOrFail($team);
    }
}
