<?php

namespace App\Forms;

use Carbon\Carbon;

class ProposalForm extends BaseForm
{
    public function name()
    {
        return $this->request->get('name');
    }

    public function clientId()
    {
        $client = (object)$this->request->get('client');
        return $client->id;
    }

    public function userId()
    {
        return (int)$this->request->get('user_id');
    }

    public function fromDate()
    {
        $date = $this->request->get('from_date');
        return Carbon::createFromFormat('d/m/Y', $date);
    }

    public function toDate()
    {
        $date = $this->request->get('to_date');
        return Carbon::createFromFormat('d/m/Y', $date);
    }

    public function budget()
    {
        return (float)$this->request->get('budget');
    }

    public function confidence()
    {
        return (int)$this->request->get('confidence');
    }
}
