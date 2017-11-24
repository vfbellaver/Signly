<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CardsCreateRequest;
use App\Http\Requests\PlanUpdateRequest;
use App\Http\Requests\TokenCreateRequest;
use App\Http\Requests\PaymentRegistrationRequest;
use App\Models\User;
use App\Services\CardService;
use App\Http\Controllers\Controller;
use Defender;
use Stripe\Customer;
use Stripe\Stripe;

class PaymentController extends Controller
{
    private $key;
    private $service;
    private $role;

    public function __construct(CardService $service)
    {
        $this->key = config('services.stripe.secret');
        Stripe::setApiKey($this->key);
        $this->service = $service;
        $this->role = Defender::findRole(User::ACCOUNT_MEMBER);
    }

    public function getCard()
    {
        $card = Customer::retrieve(auth()->user()->stripe_id)->sources->all(array(
            'limit' => 1, 'object' => 'card'));
        return $card;
    }

    public function createToken(TokenCreateRequest $request)
    {
        $data = $this->service->createToken($request->form());
        return $data;
    }

    public function updateCard(CardsCreateRequest $request)
    {
        /** @var User $user */
        $user = User::query()->find(auth()->id());
        $data = $this->service->store($user, $request);

        return $data;
    }

    public function updateSubscription(PlanUpdateRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $subscription = $user->getSubscription()->get()->first();
        $user->subscription($subscription->name)->swap($request->form()->stripe_plan());
        return [
            'message' => "Your subscription has been updated",
            'data' => $request
        ];

    }

    public function deleteSubscription(User $user)
    {
        $subscription = $user->getSubscription()->get()->first();
        $user->subscription($subscription->name)->cancelNow();
        return $response = [
            'message' => "Your subscription has been canceled",
            'data' => $user
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
        return $this->service->invoices($user);
    }

}
