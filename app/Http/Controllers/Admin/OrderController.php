<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Utility;

use App\Mail\AdminOrderShipped;
use App\Mail\ClientOrderShipped;
use App\Mail\AdminOrderDelivered;
use App\Mail\ClientOrderDelivered;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function get_orders() {
        $orders = Order::with('customer', 'status_code', 'shipping')->get();

        $orders = $orders->transform(function($order, $key) {
            $order->complete_name = $order->customer->name . ' ' . $order->customer->surname;
            return $order;
        });

        return [
            'orders' => $orders
        ];
    }

    public function get_order($id) {
        $order = Order::with('customer', 'products', 'status_code', 'shipping')->find($id);
        $order->customer->country_name = Utility::stringify_country($order->customer->country);

        return [
            'order' => $order
        ];
    }

    public function set_shipped($id) {
        $order = Order::find($id);

        $email = $order->customer->email;
        $admin_email = env('ADMIN_EMAIL', 'info@scuolamocajo.it');

        Mail::to($email)->send(new ClientOrderShipped($order));
        Mail::to($admin_email)->send(new AdminOrderShipped($order));

        $order->status_code_id = 3;
        $order->save();

        return [
            'success' => true,
            'order' => $order,
        ];
    }

    public function set_delivered($id) {
        $order = Order::find($id);

        $email = $order->customer->email;
        $admin_email = env('ADMIN_EMAIL', 'info@scuolamocajo.it');

        Mail::to($email)->send(new ClientOrderDelivered($order));
        Mail::to($admin_email)->send(new AdminOrderDelivered($order));

        $order->status_code_id = 4;
        $order->save();

        return [
            'success' => true,
            'order' => $order,
        ];
    }
}
