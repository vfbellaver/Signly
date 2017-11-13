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

    public function rateCard()
    {
        return $this->request->get('rate_card');
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

    public function photoUrl()
    {
        return $this->request->get('photo_url');
    }

    public function isIlluminated()
    {
        return (bool)$this->request->get('is_illuminated');
    }

    public function lightsOn()
    {
        return $this->request->get('lights_on');
    }

    public function lightsOff()
    {
        return $this->request->get('lights_off');
    }

    public function type()
    {
        return $this->request->get('type');
    }

    public function billboard()
    {
        $billboard = $this->request->get('billboard');
        return Billboard::query()->findOrFail($billboard);
    }


}
