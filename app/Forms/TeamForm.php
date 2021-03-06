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

    public function phone()
    {
        return $this->request->get('phone');
    }


    public function fax()
    {
        return $this->request->get('fax');
    }

    public function address()
    {
        return $this->request->get('address');
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
