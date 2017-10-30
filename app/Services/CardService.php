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

    public function __construct(){
        $this->key = "sk_test_vKQEgHfPSO1a5eJl2W0ZqUzW";
    }

    public function store(User $user,$owner)
    {

        Stripe::setApiKey("sk_test_vKQEgHfPSO1a5eJl2W0ZqUzW");

        $customer = Customer::retrieve($user->stripe_id);
        $card = $customer->sources->retrieve($customer->default_source);
        $card->name = $owner;

        try {
            $card->save();
            return "Payment made successfully";
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