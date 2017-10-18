<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\UserRegistrationRequest;
use App\Models\Team;
use App\Models\User;
use Artesaos\Defender\Facades\Defender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;


class PaymentController extends Controller
{
    private $key;
    private $role;


    public function __construct()
    {
        $this->middleware('needsRole:admin');
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        $this->key = "sk_test_vKQEgHfPSO1a5eJl2W0ZqUzW";
        $this->role = Defender::findRole('user');
    }

    public function index()
    {
        return view('payment.register');
    }

    public function store(UserRegistrationRequest $request) {

        Stripe::setApiKey($this->key);

        $team = new  Team();
        $team->name = $request->input('team');
        $team->save();

        $user = new  User();
        $user->name = $request->input('name');
        $user->email = $request->input('stripeEmail');
        $user->password = bcrypt($request->input('stripeEmail'));
        $user->remember_token = str_random(10);
        $user->team_id = $team->id;

        $user->save();

        if($user->save()) {
            $plan = $request->input('plan');
            $email = $request->input('stripeEmail');

            $user->newSubscription('main', $plan)->create(request('stripeToken'), [
                'email' => $email,
            ]);
        }

        $user->attachRole($this->role);

        return redirect('/');

    }
}
