<?php

namespace App\Forms;

class ClientForm extends BaseForm
{
	public function companyName()
	{
		return $this->request->get('company_name');
	}

	public function firstName()
	{
		return $this->request->get('first_name');
	}

	public function lastName()
	{
		return $this->request->get('last_name');
	}

	public function email()
	{
		return $this->request->get('email');
	}

	public function addressLine1()
	{
		return $this->request->get('address_line1');
	}

	public function addressLine2()
	{
		return $this->request->get('address_line2');
	}

	public function state()
	{
		return $this->request->get('state');
	}

	public function city()
	{
		return $this->request->get('city');
	}

	public function logo()
	{
		return $this->request->get('logo');
	}

	public function phone1()
	{
		return $this->request->get('phone_1');
	}

	public function phone2()
	{
		return $this->request->get('phone_2');
	}

	public function fax()
	{
		return $this->request->get('fax');
	}

	public function zipcode()
	{
		return $this->request->get('zipcode');
	}


}
