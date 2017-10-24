<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function getCard() {
        $customer = \Stripe\Customer::retrieve(auth()->user()->stripe_id);
        $card = $customer->sources->retrieve($customer->default_source);
        return dd($card);
    }
}
