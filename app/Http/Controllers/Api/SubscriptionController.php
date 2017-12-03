<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubscriptionRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Slc;
use Stripe\Card;
use Stripe\Customer;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware("needsRole:" . User::ACCOUNT_OWNER);
    }

    public function __invoke(SubscriptionRequest $request)
    {
        return \DB::transaction(function () use ($request) {
            $plan = Slc::PLAN_2;

            /** @var User $user */
            $user = auth()->user();
            $email = $request->input('email');
            $cardToken = request('card');
            Stripe::setApiKey(config('services.stripe.secret'));
            $user->newSubscription($plan['name'], $plan['id'])
                ->trialDays(3)
                ->create($cardToken, [
                    'email' => $email,
                ]);
            $user->updateCard($request->form()->source());

            $customer = Customer::retrieve($user->stripe_id);
            /** @var Card $card */
            $card = $customer->sources->retrieve($customer->default_source);
            $card->name = $request->form()->owner();
            $card->save();

        });
    }
}
