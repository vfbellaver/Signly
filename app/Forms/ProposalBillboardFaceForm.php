<?php

namespace App\Forms;

use App\Models\Client;
use Carbon\Carbon;

class ProposalBillboardFaceForm extends BaseForm
{

    public function billboardFaceId()
    {
        return $this->request->get('id');
    }

    public function price()
    {
        return (float)$this->request->get('price');
    }

    public function proposalId()
    {
        return (int)$this->request->get('proposal_id');
    }

    public function orderList()
    {
        return $this->request->get('orderList');
    }
}
