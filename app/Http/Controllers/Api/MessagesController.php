<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\MessageCreateRequest;
use App\Http\Requests\MessageUpdateRequest;
use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Services\MessageService;

class MessagesController extends Controller
{
    private $service;

    public function __construct(MessageService $service)
    {
        $this->middleware('needsRole:admin');
        $this->service = $service;
    }

    public function index()
    {
        $userId = request()->get('uid');
        return Message::query()
            ->where('user_id', $userId)
            ->where('visualized','=',false)
            ->get()->toArray();
    }

    public function store(MessageCreateRequest $request)
    {
        $data = $this->service->create($request->form());

        $response = [
            'message' => 'Billboard created.',
            'data' => $data
        ];

        return $response;
    }


    public function update(MessageUpdateRequest $request, Message $message)
    {
        $msg = $this->service->update($request->form(),$message);

        $response = [
            'message' => 'Message Read',
            'data' => $msg
        ];

        return $response;
    }
}
