<?php


namespace App\Forms;


class MessageForm extends BaseForm
{
    public function subjetc()
    {
        return $this->request->get('subject');
    }

    public function message()
    {
        return $this->request->get('message');
    }

    public function visualized()
    {
        return $this->request->get('visualized');
    }

    public function user()
    {
        return $this->request->get('user');
    }
}