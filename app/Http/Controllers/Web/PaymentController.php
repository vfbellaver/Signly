<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Services\CardService;
use App\Http\Controllers\Controller;
use View;


class PaymentController extends Controller
{
    private $key;
    private $service;

    public function __construct(CardService $service)
    {
        $this->key = config('services.stripe.secret');
        $this->service = $service;
    }

    public function index()
    {
        return view('payment.pay');
    }

    public function invoicePDF($invoiceId)
    {
        /** @var User $user */
        $user = auth()->user();
        $subscription = $user->getSubscription->toArray();
        $team = $user->team;

        return View::make('cashier::receipt', array_merge([
            'vendor' => $team->name,
            'product' => $subscription["stripe_plan"],
        ], [
            'invoice' => $this,
            'owner' => $this->owner,
            'user' => $this->owner,
        ]));

        return $user->downloadInvoice($invoiceId, [
            'vendor' => $team->name,
            'product' => $subscription["stripe_plan"],
        ]);
    }
}
