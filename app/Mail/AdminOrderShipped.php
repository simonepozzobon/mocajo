<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminOrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->customer = $order->customer;
        $this->order = $order;
        $this->amount = $order->amount;
        $this->shipping = $order->shipping;
        $this->total = $order->total;
        $this->items = $this->set_items($order);
        $this->sender = env('NO_REPLY', 'no-reply@scuolamocajo.it');
        $this->lang = 'ita';
        $this->subject = 'Ordine Spedito';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->sender)
            ->subject($this->subject)
            ->markdown('mails.admin.orders.shipped')
            ->with([
                'customer' => $this->customer,
                'order' => $this->order,
                'items' => $this->items,
                'amount' => $this->amount,
                'shipping' => $this->shipping,
                'total' => $this->total,
                'lang' => $this->lang,
            ]);
    }

    public function set_items($order) {
        $products = $order->products;
        $items = $products->transform(function($product, $key) {
            $item = array();
            $item['title'] = $product['title'];
            $item['quantity'] = $product['quantity'];
            $item['price'] = $product['price'];
            $item['pricetot'] = $product['pricetot'];
            return $item;
        });
        return $items;
    }
}
