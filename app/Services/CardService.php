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
        $this->key = config('services.stripe.secret');
    }

    public function store(User $user,$request)
    {
        try {

        Stripe::setApiKey($this->key);

        $user->updateCard($request->form()->source());

        $customer = Customer::retrieve($user->stripe_id);
        $card = $customer->sources->retrieve($customer->default_source);
        $card->name = $request->form()->owner();

            $card->save();

            return $card;

        } catch (\Stripe\Error\Card $e) {
            $body = $e->getJsonBody();
            $err = $body['error'];
            return $err->getHttpStatus();
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

    public function invoices($user)
    {
        $user = User::query()->find(auth()->id());
        $invoices = $user->InvoicesIncludingPending();

        $arrayInvoices = [];
        $i = 0;

        foreach ($invoices as $invoice) {
            $arrayInvoices[$i]   =  array([
                'date' => $invoice->date()->toFormattedDateString(),
                'total' => $invoice->total(),
                'id' => $invoice->id,
            ]);
            $i++;
        };

        return $arrayInvoices;
    }
}