<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CardsCreateRequest;
use App\Http\Requests\TokenCreateRequest;
use App\Models\Subscription;
use App\Models\User;
use App\Services\CardService;
use Artesaos\Defender\Facades\Defender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;
use Stripe\Card;
use Stripe\Customer;
use Stripe\Stripe;

class PaymentController extends Controller
{
    private $key;
    private $service;
    private $user;

    public function __construct(CardService $service)
    {
        $this->middleware('needsRole:admin');
        $this->key = "sk_test_vKQEgHfPSO1a5eJl2W0ZqUzW";
        Stripe::setApiKey($this->key);
        $this->middleware('needsRole:admin');
        $this->user = User::query()->find(auth()->id());
        $this->service = $service;
    }

    public function getCard() {
        return Customer::retrieve(auth()->user()->stripe_id)->sources->all(array(
            'limit'=>1, 'object' => 'card'));

    }

    public function createToken (TokenCreateRequest $request)
    {
        $data = $this->service->createToken($request->form());
        return $data;
    }

    public function updateCard(CardsCreateRequest $request) {

        $this->user->updateCard($request->form()->source());

        return $response = [
            'message' => "Card updated with successful",
            'data' => $this->user
        ];
    }

    public function updateSubscription($plan)
    {
        $this->user->subscription('main')->swap($plan);
        $response = [
            'message' => "Plan updated with successful",
            'data' => $plan
        ];

        return $response;
    }

    public function deleteCard(Card $card) {
        $this->user->subscription('main')->cancelNow();
        $response = [
            'message' => "Plan canceled with successful",
            'data' => $this->user
        ];
    }
}
