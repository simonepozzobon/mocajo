<?php

namespace App\Listeners;

// Model
use App\Order;
use App\Product;
use App\Customer;

// Evento per la gestione dei pagamenti
use App\Events\CreatePayment;

// Debug
use App\Mail\DebugPayment;

// Mail per l'admin
use App\Mail\AdminFailPayment;
use App\Mail\AdminSuccessOrder;
use App\Mail\AdminRefusedPayment;

// Mail per i client
use App\Mail\ClientFailPayment;
use App\Mail\ClientSuccessOrder;
use App\Mail\ClientRefusedPayment;

// Librerie
use Illuminate\Support\Arr;
use Cartalyst\Stripe\Stripe;
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
        $this->admin_email = env('ADMIN_EMAIL', 'info@scuolamocajo.it');
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
        $admin_email = $this->admin_email;

        $id = $event->id;
        $order = Order::find($id);
        $customer = $order->customer;

        // Calcolo il totale dell'ordine
        $total = $this->calculate_total($order->products);
        $order->amount = $total;
        $order->save();

        $stripe = $this->connect();

        try {
            // mi connetto e creo un token
            $token = $stripe->tokens()->create([
                'card' => $event->card,
            ]);
        } catch (\Exception $e) {
            // Se la carta non viene approvata devo mandare un messaggio di errore
            $json = json_encode('Carta rifiutata');
            $debug = Mail::to('gianni@email.com')->send(new DebugPayment($json));
            $order->status_code_id = 6;
            $order->save();
        }

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

        // genero il trasferimento
        try {
            $charge = $stripe->charges()->create([
                'customer' => $customer->stripe_id,
                'currency' => 'EUR',
                'amount' => $total,
                'description' => 'order n. '.$order->id,
                'statement_descriptor' => 'SUCOLAMOCAJO',
                'metadata' => $metadata,
            ]);
            $order->transaction_id = $charge['id'];

        } catch (\Exception $e) {
            // Invia Messaggio di errore pagamento non riuscito
            $json = json_encode($e);
            $debug = Mail::to('gianni@email.com')->send(new DebugPayment($json));
            $client_payment_fail = Mail::to($customer->email)->send(new ClientFailPayment($order));
            $admin_payment_fail = Mail::to($admin_email)->send(new AdminFailPayment($order));
            $order->status_code_id = 5;
            $order->save();

        }
        // set order paid
        $order->status_code_id = 2;
        $order->save();

        // Invio la mail al cliente
        $client_success = Mail::to($customer->email)->send(new ClientSuccessOrder($order));
        $admin_success = Mail::to($admin_email)->send(new AdminSuccessOrder($order));

        return true;
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
