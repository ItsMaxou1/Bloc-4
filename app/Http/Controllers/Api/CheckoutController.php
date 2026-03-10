<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $amount = $request->input('amount');  // en cents, p.ex. 500 pour 5,00 €
        $currency = $request->input('currency', 'eur');

        $intent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => $currency,
            // p.ex. metadata pour lier à la commande
            'metadata' => ['order_id' => $request->input('order_id')],
        ]);

        return response()->json([
            'clientSecret' => $intent->client_secret,
        ]);
    }
}
