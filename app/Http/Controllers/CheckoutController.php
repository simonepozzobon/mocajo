<?php

namespace App\Http\Controllers;

use App\Order;
Use App\Customer;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;

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
        $order->status_code = 0;
        $order->shipping_id = 1;
        $order->save();

        // $customer_id = $customer->stripe_id;
        //
        // $items = array();
        //
        foreach ($request->products as $key => $product) {
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
            // array_push($items, [
            //     'type' => $product['id'],
            //     'parent' => $product['title'],
            // ]);
        }

        // $ord = $stripe->orders()->create([
        //     'currency' => 'EUR',
        //     'customer' => $customer_id,
        //     'email' => $customer->email,
        //     'shipping' => [
        //         'name' => $this->stringify_result(['surname', 'name'], $request->checkout),
        //         'address' => [
        //             'line1' => $this->stringify_result(['address_secondary', 'address'], $request->checkout),
        //             'city' => $request->checkout['city'],
        //             'country' => $request->checkout['country'],
        //             'postal_code' => $request->checkout['cap'],
        //         ],
        //     ],
        //     'items' => $items,
        // ]);

        return [
            'customer' => $customer,
            'order' => $order,
        ];
    }

    public function pay(Request $request) {
        $stripe = $this->stripe;

        $local_order = Order::find($request->order_id);
        $local_customer = $local_order->customer;

        $products = $local_order->products;

        $customer_id = $local_customer->stripe_id;
        $card_id = $local_customer->card_id;

        $card_data = [
                'number' => $request->number,
                'exp_month' => $request->expiry_month,
                'exp_year' => $request->expiry_year,
                'cvc' => $request->cvv,
        ];

        if (!$card_id) {
            $token = $stripe->tokens()->create([
                'card' => $card_data
            ]);
            $card = $stripe->cards()->create($customer_id, $token['id']);
        } else {
            $card = $stripe->cards()->find($customer_id, $card_id);
            $delete = $stripe->cards()->delete($customer_id, $card_id);
            $token = $stripe->tokens()->create([
                'card' => $card_data
            ]);
            $card = $stripe->cards()->create($customer_id, $token['id']);
        }

        $local_customer->card_id = $card['id'];
        $local_customer->save();

        // $customer = $this->get_customer($customer_id);
        $metadata = $this->set_charge_metadata($products, $local_order->id);
        $total = $this->order_total($products);
        // return [$metadata][0];
        $charge = $stripe->charges()->create([
            'customer' => $customer_id,
            'currency' => 'EUR',
            'amount' => $total,
            'description' => 'order n. '.$local_order->id,
            'statement_descriptor' => 'SUCOLAMOCAJO',
            'metadata' => $metadata,
        ]);

        return [
            'order' => $card,
        ];
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

    public function order_total($products) {
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
