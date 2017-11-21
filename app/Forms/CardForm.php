<?php

namespace App\Forms;

class CardForm extends BaseForm
{
    public function id()
    {
        return $this->request->get('id');
    }

    public function source()
    {
        return $this->request->get('source');
    }

    public function stripe_id()
    {
        return $this->request->get('stripe_id');
    }

    public function stripe_plan()
    {
        return $this->request->get('stripe_plan');
    }

    public function number()
    {
        return $this->request->get('number');
    }

    public function cvc()
    {
        return $this->request->get('cvc');
    }

    public function address_country()
    {
        return $this->request->get('address_country');
    }

    public function address_state()
    {
        return $this->request->get('address_state');
    }

    public function address_zip()
    {
        return $this->request->get('address_zip');
    }

    public function brand()
    {
        return $this->request->get('brand');
    }

    public function country()
    {
        return $this->request->get('country');
    }

    public function customer()
    {
        return $this->request->get('customer');
    }

    public function cvc_check()
    {
        return $this->request->get('cvc_check');
    }

    public function exp_month()
    {
        return $this->request->get('exp_month');
    }

    public function exp_year()
    {
        return $this->request->get('exp_year');
    }

    public function fingerprint()
    {
        return $this->request->get('fingerprint');
    }

    public function funding()
    {
        return $this->request->get('funding');
    }

    public function last4()
    {
        return $this->request->get('last4');
    }

    public function owner()
    {
        return $this->request->get('owner');
    }
}
