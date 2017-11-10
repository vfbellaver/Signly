<?php

namespace App\Forms;

use App\Models\Client;
use Carbon\Carbon;

class ProposalBillboardFaceForm extends BaseForm
{

    public function billboardFaceId()
    {
        $client = (object)$this->request->get('billboard_face');
        return $client->id;
    }

    public function price()
    {
        return (float)$this->request->get('price');
    }

    public function order()
    {
        return (int)$this->request->get('order');
    }
}
