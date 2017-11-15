<?php

namespace App\Forms;

class TeamForm extends BaseForm
{
    public function name()
    {
        return $this->request->get('name');
    }

    public function email()
    {
        return $this->request->get('email');
    }

    public function phone1()
    {
        return $this->request->get('phone1');
    }

    public function phone2()
    {
        return $this->request->get('phone2');
    }

    public function fax()
    {
        return $this->request->get('fax');
    }

    public function address_line1()
    {
        return $this->request->get('address_line1');
    }
    public function address_line2()
    {
        return $this->request->get('address_line2');
    }

    public function city()
    {
        return $this->request->get('city');
    }

    public function state()
    {
        return $this->request->get('state');
    }

    public function zipcode()
    {
        return $this->request->get('zipcode');
    }

    public function slug()
    {
        return $this->request->get('slug');
    }

    public function logo()
    {
        return $this->request->get('logo');
    }
}
