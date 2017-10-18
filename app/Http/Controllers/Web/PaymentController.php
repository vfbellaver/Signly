<?php

namespace App\Http\Controllers\Web;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\{Stripe, Charge, Customer, Plan, Card};
use laravel\Cashier\Cashier;


class PaymentController extends Controller
{
    private $key;


    public function __construct()
    {
        $this->middleware('needsRole:admin');
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        $this->key = "sk_test_vKQEgHfPSO1a5eJl2W0ZqUzW";
    }

    public function index()
    {
        $teams = Team::all();
        if (auth()->check())
            return view('payment.index',compact('teams'));
    }

    public function store() {

        Stripe::setApiKey($this->key);
        $user = User::findOrFail(auth()->id());
        $plan = request()->input('plan');

        $user->newSubscription('main', $plan)->create(request('stripeToken'), [
            'email' => request('stripeEmail'),
        ]);



        /*
        $custumer = Customer::create([
            'email' => request('stripeEmail'),
            'source' => request('stripeToken'),
        ]);

        Charge::create([
           'currency' => 'usd',
           'customer' => $custumer->id,
           'amount' => $amount
        ]);
        */
        return dd(request()->toArray());

    }
}
