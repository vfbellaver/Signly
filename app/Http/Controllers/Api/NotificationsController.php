<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\MessageCreateRequest;
use App\Http\Requests\NotificationUpdateRequest;
use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\MessageService;

class NotificationsController extends Controller
{
    private $service;

    public function __construct(MessageService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $user = auth()->user();
        $notifications = $user->notifications;
        return $notifications;
    }

    public function update(NotificationUpdateRequest $request, Notification $message)
    {
        return null;
    }
}
