<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;
// use App\Events\CreatePayment;
use Cartalyst\Stripe\Exception;
use Cartalyst\Stripe\Exception\NotFoundException;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\BadRequestException;
use Cartalyst\Stripe\Exception\InvalidRequestException;
use Cartalyst\Stripe\Exception\MissingParameterException;

class CheckoutController extends Controller
{

    public function __construct() {
        $key = env('PUBLISHABLE_KEY', '');
        $secret = env('SECRET_KEY', '');
        $this->stripe = Stripe::make($key);
        $this->stripe->setApiKey($secret);
    }

    public function new_order(Request $request) {
        $customer = Customer::where('email', $request->checkout['email'])->first();
        $stripe = $this->stripe;

        if (!$customer) {

            $stripe_customer = $stripe->customers()->create([
                'email' => $request->checkout['email'],
            ]);

            $customer = new Customer();
            $customer->email = $request->checkout['email'];
            $customer->stripe_id = $stripe_customer['id'];
            $customer->category = $request->checkout['category'];
            $customer->company_name = $request->checkout['company_name'];
            $customer->vat = $request->checkout['vat'];
            $customer->code = $request->checkout['code'];
            $customer->name = $request->checkout['name'];
            $customer->surname = $request->checkout['surname'];
            $customer->phone = $request->checkout['phone'];
            $customer->country = $request->checkout['country'];
            $customer->region = $request->checkout['region'];
            $customer->city = $request->checkout['city'];
            $customer->cap = $request->checkout['cap'];
            $customer->address = $request->checkout['address'];
            $customer->address_secondary = $request->checkout['address_secondary'];
            $customer->card_id = null;
            $customer->captcha_validated = 0;
            $customer->save();
        }

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->status_code_id = 1;
        $order->shipping_id = $request->shipping['id'];
        $order->save();
        //
        // $order->amount = $request->amount;
        // $order->save();

        $amount = 0;
        $shipping_items = 0;

        foreach ($request->products as $key => $product) {
            $single = $product['price'] * $product['quantity'];
            $shipping_items = $shipping_items + $product['quantity'];
            $amount = $amount + $single;
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        $shipping = $request->shipping['increment'] * $request->shipping['increment'] * $shipping_items;
        $order->amount = $amount;
        $order->shipping = $shipping;
        $order->total = $shipping + $amount;
        $order->save();

        return [
            'customer' => $customer,
            'order' => $order,
        ];
    }

    public function pay(Request $request) {

        $test_card = $this->get_test_card('success');

        $request = (object) [
            'currency' => 'EUR',
            'customer_id' => 1,
            'cvv' => $test_card['cvv'],
            'expiry_month' => $test_card['expiry_month'],
            'expiry_year' => $test_card['expiry_year'],
            'number' => $test_card['number'],
            'order_id' => 42,
        ];

        $errors = array();
        $order = Order::find($request->order_id);
        $customer = $order->customer;
        $products = $order->products;

        try {
            $token = $this->stripe->tokens()->create([
                'card' => [
                    'number' => $request->number,
                    'exp_month' => $request->expiry_month,
                    'exp_year' => $request->expiry_year,
                    'cvc' => $request->cvv,
                ],
            ]);
        } catch (NotFoundException $e) {
            $message = $e->getMessage();
            $errors['step_1'] = $message;
        } catch (BadRequestException $e) {
            $message = $e->getMessage();
            $errors['step_1'] = $message;
        } catch (InvalidRequestException $e) {
            $message = $e->getMessage();
            $errors['step_1'] = $message;
        } catch (CardErrorException $e) {
            $message = $e->getMessage();
            $errors['step_1'] = $message;
        }

        if (count($errors) > 0) {
            $this->payment_fail($order);
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        if (isset($token)) {
            // verifico l'impronta
            $fingerprint = $token['card']['fingerprint'];
            $cards = $this->stripe->cards()->all($customer->stripe_id);


            // verifico che non ci siano doppioni
            $checks = Arr::where($cards['data'], function($card, $key) use($fingerprint) {
                return $card['fingerprint'] != $fingerprint;
            });

            // se l'impronta è diversa aggiungo la nuova carta
            if (count($checks) > 0) {
                try {
                    $card = $this->stripe->cards()->create($customer['stripe_id'], $token['id']);
                    $customer->card_id = $card['id'];
                    $customer->save();
                } catch (NotFoundException $e) {
                    $message = $e->getMessage();
                    $errors['step_1_2'] = $message;
                } catch (BadRequestException $e) {
                    $message = $e->getMessage();
                    $errors['step_1_2'] = $message;
                } catch (InvalidRequestException $e) {
                    $message = $e->getMessage();
                    $errors['step_1_2'] = $message;
                } catch (CardErrorException $e) {
                    $message = $e->getMessage();
                    $errors['step_1_2'] = $message;
                }

                if (count($errors) > 0) {
                    // Messaggio errore Carta Rifiutata
                    $this->payment_refused($order);
                    return [
                        'success' => false,
                        'errors' => $errors,
                    ];
                }
            }

            // set metadata
            $metadata = array();
            $metadata['order_id'] = $order->id;

            foreach ($products as $key => $product) {
                $metadata['item_'.$key] = json_encode([
                    'quantity' => $product->pivot->quantity,
                    'product_id' => $product->id,
                    'product_price' => $product->price
                ]);
            }


            // effettuo l'addebito
            try {
                $charge = $this->stripe->charges()->create([
                    'customer' => $customer->stripe_id,
                    'currency' => 'EUR',
                    'amount' => $order->total,
                    'description' => 'order n. '.$order->id,
                    'statement_descriptor' => 'SUCOLAMOCAJO',
                    'metadata' => $metadata,
                ]);

            } catch (NotFoundException $e) {
                $message = $e->getMessage();
                $errors['step_2'] = $message;
            } catch (BadRequestException $e) {
                $message = $e->getMessage();
                $errors['step_2'] = $message;
            } catch (InvalidRequestException $e) {
                $message = $e->getMessage();
                $errors['step_2'] = $message;
            } catch (CardErrorException $e) {
                $message = $e->getMessage();
                $errors['step_2'] = $message;
            } catch (MissingParameterException $e) {
                $message = $e->getMessage();
                $errors['step_2'] = $message;
            }

            if (count($errors) > 0) {
                // Messaggio errore Carta Rifiutata
                $this->payment_refused($order);
                return [
                    'success' => false,
                    'errors' => $errors,
                ];
            }

            if (isset($charge)) {
                $order->transaction_id = $charge['id'];
                $order->status_code_id = 2;
                $order->save();

                $this->order_success($order);

                return [
                    'success' => true,
                ];
            }
        }

    }

    public function order_success($order) {
        $email = $order->customer->email;
        $admin_email = env('ADMIN_EMAIL', 'info@scuolamocajo.it');

        dump('success');
        Mail::to($email)->send(new ClientSuccessOrder($order));
        Mail::to($admin_email)->send(new AdminSuccessOrder($order));

        $order->status_code_id = 2;
        $order->save();
        return true;
    }

    public function payment_fail($order) {
        $email = $order->customer->email;
        $admin_email = env('ADMIN_EMAIL', 'info@scuolamocajo.it');

        dump('fail');
        Mail::to($email)->send(new ClientFailPayment($order));
        Mail::to($admin_email)->send(new AdminFailPayment($order));

        $order->status_code_id = 5;
        $order->save();

        return true;
    }

    public function payment_refused($order) {
        $email = $order->customer->email;
        $admin_email = env('ADMIN_EMAIL', 'info@scuolamocajo.it');

        dump('refused');
        Mail::to($email)->send(new ClientRefusedPayment($order));
        Mail::to($admin_email)->send(new AdminRefusedPayment($order));

        $order->status_code_id = 5;
        $order->save();
        return true;
    }

    public function get_customer($id) {
        return $this->stripe->customers()->find($id);
    }

    public function set_charge_metadata($products, $order_id) {
        $metadata = array();
        $metadata['order_id'] = $order_id;
        foreach ($products as $key => $product) {
            $metadata['item_'.$key] = json_encode([
                'quantity' => $product->pivot->quantity,
                'product_id' => $product['id'],
                'product_price' => $product['price'],
            ]);
        }
        return $metadata;
    }

    public function order_total($order) {
        $products = $order->products;

        $total = 0;
        foreach ($products as $key => $product) {
            $single = $product->pivot->quantity * $product['price'];
            $total = $total + $single;
        }

        return $total;
    }

    public function stringify_result($fields, $request) {
        $string = '';

        foreach ($fields as $key => $field) {
            if ($key == 0) {
                $string = $request[$field];
            } else {
                if ($field == 'country') {
                    $string = $string .', '. $this->stringify_country($request[$field]);
                } else {
                    $string = $string .' '. $request[$field];
                }
            }
        }

        return $string;
    }

    public function stringify_country($id) {
        $countries = [
            "Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas"
            ,"Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands"
            ,"Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica"
            ,"Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea"
            ,"Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana"
            ,"Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India"
            ,"Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia"
            ,"Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania"
            ,"Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia"
            ,"New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal"
            ,"Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles"
            ,"Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","St. Lucia","Sudan"
            ,"Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia"
            ,"Turkey","Turkmenistan","Turks &amp; Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","United States Minor Outlying Islands","Uruguay"
            ,"Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"
        ];

        return $countries[$id];
    }

    public function test() {
    }

    public function get_test_card($type) {
        $cards = [
            'success' => [
                'cvv' => 314,
                'expiry_month' => 10,
                'expiry_year' => 2020,
                'number' => '4242424242424242',
            ],
            'wrong_month' => [
                'cvv' => 314,
                'expiry_month' => 13,
                'expiry_year' => 2020,
                'number' => '4242424242424242',
            ],
            'wrong_year' => [
                'cvv' => 314,
                'expiry_month' => 10,
                'expiry_year' => 1970,
                'number' => '4242424242424242',
            ],
            'risk_level_elevated' => [
                'cvv' => 314,
                'expiry_month' => 10,
                'expiry_year' => 2020,
                'number' => '4000000000009235',
            ],
            'declined' => [
                'cvv' => 314,
                'expiry_month' => 10,
                'expiry_year' => 2020,
                'number' => '4000000000000002',
            ],
            'insufficient_funds' => [
                'cvv' => 314,
                'expiry_month' => 10,
                'expiry_year' => 2020,
                'number' => '4000000000009995',
            ],
            'lost_card' => [
                'cvv' => 314,
                'expiry_month' => 10,
                'expiry_year' => 2020,
                'number' => '4000000000009987',
            ],
            'stolen_card' => [
                'cvv' => 314,
                'expiry_month' => 10,
                'expiry_year' => 2020,
                'number' => '4000000000009979',
            ],
            'expired' => [
                'cvv' => 314,
                'expiry_month' => 10,
                'expiry_year' => 2020,
                'number' => '4000000000000069',
            ],
            'wrong_cvc' => [
                'cvv' => 314,
                'expiry_month' => 10,
                'expiry_year' => 2020,
                'number' => '4000000000000127',
            ],
            'processing_error' => [
                'cvv' => 314,
                'expiry_month' => 10,
                'expiry_year' => 2020,
                'number' => '4000000000000119',
            ],
            'incorrect_number' => [
                'cvv' => 314,
                'expiry_month' => 10,
                'expiry_year' => 2020,
                'number' => '4242424242424241',
            ],
        ];

        return $cards[$type];
    }
}
