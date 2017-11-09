<?php

namespace App\Forms;

use App\Models\Client;

class ProposalForm extends BaseForm
{
    public function name()
    {
        return $this->request->get('name');
    }

    public function client()
    {
        $client = (object)$this->request->get('client');
        return Client::query()->findOrFail($client->id);
    }

    public function expiresOn()
    {
        return $this->transformDate($this->request->get('expires_on'));
    }
}
