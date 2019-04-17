<?php

namespace App\Listeners;

use App\Order;
use App\Product;
use App\Customer;
use App\Mail\DebugPayment;
use Illuminate\Support\Arr;
use Cartalyst\Stripe\Stripe;
use App\Events\CreatePayment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetPayment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->key = env('PUBLISHABLE_KEY', '');
        $this->secret = env('SECRET_KEY', '');
        $this->stripe = Stripe::make($this->key);
        $this->stripe->setApiKey($this->secret);
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreatePayment $event)
    {

        $id = $event->id;
        $order = Order::find($id);
        $customer = $order->customer;

        // Calcolo il totale dell'ordine
        $total = $this->calculate_total($order->products);
        $order->amount = $total;
        $order->save();

        try {
            // mi connetto e creo un token
            $stripe = $this->connect();
            $token = $stripe->tokens()->create([
                'card' => $event->card,
            ]);

            // verifico l'impronta
            $fingerprint = $token['card']['fingerprint'];
            $cards = $stripe->cards()->all($customer->stripe_id);

            // verifico che non ci siano doppioni
            $checks = Arr::where($cards['data'], function($card, $key) use($fingerprint) {
                return $card['fingerprint'] != $fingerprint;
            });

            // se l'impronta è diversa aggiungo la nuova carta
            if (count($checks) > 0) {
                $card = $stripe->cards()->create($customer['id'], $token['id']);
                $customer->card_id = $card['id'];
                $customer->save();
            }
        } catch (\Exception $e) {
            // Se la carta non viene approvata devo mandare un messaggio di errore
            return [false];
        }

        // genero il trasferimento
        try {
            $metadata = $this->set_charge_metadata($order->products, $order->id);
            $charge = $this->stripe->charges()->create([
                'customer' => $customer->stripe_id,
                'currency' => 'EUR',
                'amount' => $total,
                'description' => 'order n. '.$order->id,
                'statement_descriptor' => 'SUCOLAMOCAJO',
                'metadata' => $metadata,
            ]);
        } catch (\Exception $e) {
            // Invia Messaggio di errore pagamento non riuscito
            return [false];
        }
        
        $json = json_encode($charge);
        Mail::to('gianni@email.com')->send(new DebugPayment($json));
        return [true];
    }

    public function connect() {
        $stripe = Stripe::make($this->key);
        $stripe->setApiKey($this->secret);
        return $stripe;
    }

    public function calculate_total($products) {
        $total = 0;
        foreach ($products as $key => $product) {
            $single = $product->pivot->quantity * $product['price'];
            $total = $total + $single;
        }
        return $total;
    }

    public function set_charge_metadata($products, $id) {
        $metadata = array();
        $metadata['order_id'] = $id;

        foreach ($products as $key => $product) {
            $metadata['item_'.$key] = json_encode([
                'quantity' => $product->pivot->quantity,
                'product_id' => $product['id'],
                'product_price' => $product['price'],
            ]);
        }
        return $metadata;
    }

}
