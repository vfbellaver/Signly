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

    public function __construct(CardService $service)
    {
        $this->middleware('needsRole:admin');
        $this->key = "sk_test_vKQEgHfPSO1a5eJl2W0ZqUzW";
        Stripe::setApiKey($this->key);
        $this->middleware('needsRole:admin');
        $this->service = $service;

    }

    public function getCard() {
        return \Stripe\Customer::retrieve(auth()->user()->stripe_id)->sources->all(array(
            'limit'=>1, 'object' => 'card'));

    }

    public function createToken (TokenCreateRequest $request)
    {
        $data = $this->service->createToken($request->form());
        return $data;
    }

    public function updateCard(CardsCreateRequest $request) {

        $user = User::query()->find(1);

        $user->updateCard($request->form()->source());

        return $response = [
            'message' => "Plan updated with successful",
            'data' => $user
        ];
    }

    public function updateSubscription($plan)
    {
        $user = User::Find(1);
        $user->subscription('main')->cancel();
        $response = [
            'message' => "Plan updated with successful",
            'data' => $plan
        ];

        return $response;
    }

    public function createCard() {

    }

    public function deleteCard(Card $card) {
        $customer = Customer::retrieve(auth()->user()->stripe_id);
        $customer->sources->retrieve("card_1BGtJiBxxlqj1r2NeKz0pxr5")->delete();
    }
}
