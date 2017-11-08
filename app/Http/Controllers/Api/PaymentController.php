<?php

namespace App\Http\Controllers\Api;

use App\Forms\UserForm;
use App\Http\Requests\CardsCreateRequest;
use App\Http\Requests\TokenCreateRequest;
use App\Http\Requests\PaymentRegistrationRequest;
use App\Models\Team;
use App\Models\User;
use App\Services\CardService;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Defender;
use Stripe\Customer;
use Stripe\Stripe;

class PaymentController extends Controller
{
    private $key;
    private $service;
    private $user;
    private $role;

    public function __construct(CardService $service)
    {
        $this->key = config('services.stripe.secret');
        Stripe::setApiKey($this->key);
        $this->service = $service;
        $this->role = Defender::findRole('user');
    }

    public function getCard()
    {
        return Customer::retrieve(auth()->user()->stripe_id)->sources->all(array(
            'limit' => 1, 'object' => 'card'));
    }

    public function createToken(TokenCreateRequest $request)
    {
        $data = $this->service->createToken($request->form());
        return $data;
    }

    public function updateCard(CardsCreateRequest $request)
    {
        $user = User::query()->find(auth()->id());
        $user->updateCard($request->form()->source());
        $data = $this->service->store($user, $request->form()->owner());

        return $response = [
            'message' => "Card updated with successful",
            'data' => $data
        ];
    }

    public function updateSubscription($plan)
    {
        $user = User::query()->find(auth()->id());
        $user->subscription('main')->swap($plan);

        return [

            'message' => "Plan updated with successful",
            'data' => $plan
        ];

    }

    public function deleteSubscription(User $user)
    {
        $user->subscription('main')->cancelNow();
        return $response = [
            'message' => "Plan canceled with successful",
            'data' => $this->user
        ];
    }

    public function verify(PaymentRegistrationRequest $request)
    {
        $data = $request->all();
        return $response = [
            'message' => 'User saved with successful',
            'data' => $data
        ];
    }

    public function invoices()
    {
        $user = User::query()->find(auth()->id());
        $invoices = $user->InvoicesIncludingPending();
        return $invoices;
    }

}
