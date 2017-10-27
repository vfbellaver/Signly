<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\UserRegistrationRequest;
use App\Models\Team;
use App\Models\User;
use App\Services\CardService;
use Artesaos\Defender\Facades\Defender;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use function GuzzleHttp\Psr7\str;
use Request;
use Stripe\Card;
use Stripe\Stripe;


class PaymentController extends Controller
{
    private $key;
    private $role;
    private $service;


    public function __construct(CardService $service)
    {
        $this->middleware('needsRole:admin');
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        $this->key = "sk_test_vKQEgHfPSO1a5eJl2W0ZqUzW";
        $this->role = Defender::findRole('user');
        $this->service = $service;
    }

    public function index()
    {
        //return view('payment.register');
        return view('payment.index');
    }

    public function getCard()
    {
        Stripe::setApiKey($this->key);
        return \Stripe\Customer::retrieve(auth()->user()->stripe_id)->sources->all(array(
            'limit' => 1, 'object' => 'card'));

    }

    public function termsAccept()
    {
        $planId = bcrypt(request()->post('id'));
        return $planId;
    }

    public function registerUser($plan)
    {
        return view('payment.user-form', compact('plan'));
    }

    public function store(UserRegistrationRequest $request)
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

        $plan = $request->input('plan');
        $email = $request->input('email');
        $owner = $request->input('owner');

        Stripe::setApiKey($this->key);


        $user->newSubscription('main', $plan)
            ->trialDays(14)
            ->create(request('stripeToken'), [
                'email' => $email,
            ]);

        $data = $this->service->store($user, $owner);

        $response = [
            "message" => "Payment made successfully",
            "data" => $data
        ];

        return view('user.index', compact('user', 'response'));

    }
}
