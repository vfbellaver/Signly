<?php

namespace App\Forms;

class BillboardForm extends BaseForm
{
	public function name()
	{
		return $this->request->get('name');
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


}
