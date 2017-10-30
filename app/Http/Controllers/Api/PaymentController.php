<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CardsCreateRequest;
use App\Http\Requests\TokenCreateRequest;
use App\Http\Requests\PaymentRegistrationRequest;
use App\Models\Team;
use App\Models\User;
use App\Services\CardService;
use Artesaos\Defender\Facades\Defender;
use Carbon\Carbon;
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
    private $role;

    public function __construct(CardService $service)
    {
        $this->key = "sk_test_vKQEgHfPSO1a5eJl2W0ZqUzW";
        Stripe::setApiKey($this->key);
        $this->service = $service;
        $this->role = Defender::findRole('user');
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
        $user = User::query()->find(auth()->id());
        $user->updateCard($request->form()->source());

        return $response = [
            'message' => "Card updated with successful",
            'data' => $this->user
        ];
    }

    public function updateSubscription($plan)
    {
        $user = User::query()->find(auth()->id());
        $user->subscription('main')->swap($plan);
        $response = [
            'message' => "Plan updated with successful",
            'data' => $plan
        ];

        return $response;
    }

    public function deleteSubscription() {
        $user = User::query()->find(auth()->id());
        $user->subscription('main')->cancelNow();
        return $response = [
            'message' => "Plan canceled with successful",
            'data' => $this->user
        ];
    }

    public function verify (PaymentRegistrationRequest $request)
    {
        $data = $request->all();

        return $response = [
          'message' => 'User saved with successful',
            'data' => $data
        ];
    }

    public function store(PaymentRegistrationRequest $request)
    {
        $team = new  Team();
        $team->name = $request->input('team');
        $team->save();

        $user = new  User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->remember_token = str_random(10);
        $user->team_id = $team->id;
        $user->trial_ends_at = Carbon::now()->addDays(14);

        $user->save();
        $user->attachRole($this->role);

        $plan = $request->input('plan');
        $email = $request->input('email');
        $owner = $request->input('owner');

        Stripe::setApiKey($this->key);

        $user->newSubscription('main', $plan)
            ->trialDays(14)
            ->create(request('source'), [
                'email' => $email,
            ]);

        $data = $this->service->store($user, $owner);

        $response = [
            "message" => $data,
            "data" => $data,
        ];

        return $response;

    }
}
