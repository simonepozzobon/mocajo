<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;

class CheckoutController extends Controller
{
    public function new_order(Request $request) {

    }

    public function pay(Request $request) {

    }

    public function test() {
        $request = [
            'card' => '4242424242424242',
            'expiry_month' => 10,
            'expiry_year' => 2020,
            'cvv' => 314,
            'amount' => 10.00,
            'currency' => 'EUR',
            'description' => 'Ordine 39292840934',
        ];

        $key = env('PUBLISHABLE_KEY', '');
        $secret = env('SECRET_KEY', '');

        try {
            $stripe = Stripe::make($key);
            dump($stripe);
        } catch(\Exception $e) {
            dd('errore');
        }

        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request['card'],
                    'exp_month' => $request['expiry_month'],
                    'exp_year' => $request['expiry_year'],
                    'cvc' => $request['cvv'],
                ]
            ]);

            $stripe->setApiKey($secret);

            $settings = [
                'card' => $token['id'],
                'currency' => $request['currency'],
                'amount' => $request['amount'],
                'description' => $request['description'],
            ];
            $charge = $stripe->charges()->create($settings);

        } catch (\Exception $e) {
          // Something else happened, completely unrelated to Stripe
          dd($e);
        }

    }
}
