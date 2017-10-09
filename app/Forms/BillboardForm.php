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

    public function user()
    {
        $user = auth()->user()->id;
        return User::query()->findOrFail($user);
    }

}
