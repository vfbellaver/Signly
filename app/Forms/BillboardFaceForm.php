<?php


namespace App\Forms;

use App\Models\Billboard;

class BillboardFaceForm extends BaseForm
{
    public function code()
    {
        return $this->request->get('code');
    }

    public function height()
    {
        return $this->request->get('height');
    }

    public function width()
    {
        return $this->request->get('width');
    }

    public function reads()
    {
        return $this->request->get('reads');
    }

    public function label()
    {
        return $this->request->get('label');
    }

    public function signType()
    {
        return $this->request->get('sign_type');
    }

    public function hardCost()
    {
        return $this->request->get('hard_cost');
    }

    public function monthlyImpressions()
    {
        return $this->request->get('monthly_impressions');
    }

    public function notes()
    {
        return $this->request->get('notes');
    }

    public function maxAds()
    {
        return $this->request->get('max_ads');
    }

    public function duration()
    {
        return $this->request->get('duration');
    }

    public function photo()
    {
        return $this->request->get('photo');
    }

    public function isIluminated()
    {
        return $this->request->get('is_iluminated');
    }

    public function billboard()
    {
        $billboard = $this->request->get('billboard');
        return Billboard::query()->findOrFail($billboard);
    }


}
