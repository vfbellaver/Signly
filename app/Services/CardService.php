<?php

namespace App\Services;

use App\Events\ClientCreated;
use App\Events\ClientDeleted;
use App\Events\ClientUpdated;
use App\Forms\CardForm;
use App\Forms\ClientForm;
use App\Forms\UserForm;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Storage;
use Stripe\Card;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\Token;

class CardService
{

    /**
     * CardService constructor.
     */

    private $key;

    public function __construct()
    {
        $this->key = "sk_test_vKQEgHfPSO1a5eJl2W0ZqUzW";
    }

    public function updateCard(CardForm $form): Card
    {


        $customer = Customer::retrieve($form->stripe_id());
        $card = $customer->sources->retrieve($form->id());

        $card->id = $form->id();

        $card->address_country = $form->address_country();

        $card->address_state = $form->address_state();

        $card->address_zip = $form->address_zip();

        $card->brand = $form->brand();

        $card->country = $form->country();

        $card->customer = $form->customer();

        $card->cvc_check = $form->cvc_check();

        $card->exp_month = $form->exp_month();

        $card->exp_year = $form->exp_year();

        $card->fingerprint = $form->fingerprint();

        $card->funding = $form->funding();

        $card->last4 = $form->last4();

        $card->name = $form->name();

        try {
            $card->save();
            return "Ok";
        } catch (\Stripe\Error\Card $e) {
            $body = $e->getJsonBody();
            $err = $body['error'];
            return $e->getHttpStatus();
        } catch (\Stripe\Error\RateLimit $e) {
            return $e;
        } catch (\Stripe\Error\InvalidRequest $e) {
            return $e;
        } catch (\Stripe\Error\Authentication $e) {
            return $e;
        } catch (\Stripe\Error\ApiConnection $e) {
            return $e;
        } catch (\Stripe\Error\Base $e) {
            return $e;
        } catch (Exception $e) {
            return $e;
        }

    }

    public function store(User $user, Request $request)
    {

        Stripe::setApiKey($this->key);

        $plan = $request->input('plan');
        $email = $request->input('email');
        $owner = $request->input('owner');

        $user->newSubscription('main', $plan)
            ->trialDays(14)
            ->create(request('stripeToken'), [
                'email' => $email,
            ]);

        $customer = Customer::retrieve($user->stripe_id);
        $card = $customer->sources->retrieve($customer->default_source);
        $card->name = $owner;

        try {
            $card->save();
            return "Ok";
        } catch (\Stripe\Error\Card $e) {
            $body = $e->getJsonBody();
            $err = $body['error'];
            return $e->getHttpStatus();
        } catch (\Stripe\Error\RateLimit $e) {
            return $e;
        } catch (\Stripe\Error\InvalidRequest $e) {
            return $e;
        } catch (\Stripe\Error\Authentication $e) {
            return $e;
        } catch (\Stripe\Error\ApiConnection $e) {
            return $e;
        } catch (\Stripe\Error\Base $e) {
            return $e;
        } catch (Exception $e) {
            return $e;
        }

    }

    public function createToken(CardForm $form)
    {
        Stripe::setApiKey($this->key);

        return Token::create(array(

            "card" => array(
                "number" => $form->number(),
                "exp_month" => $form->exp_month(),
                "exp_year" => $form->exp_year(),
                "cvc" => $form->cvc(),
                "address_zip" => $form->address_zip()
            )

        ));

    }
}