<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminRefusedPayment extends Mailable
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
        $this->sender = env('SHOP_MAIL', 'info@scuolamocajo.it');
        $this->lang = 'ita';
        $this->subject = 'Nuovo ordine - pagamento rifiutato';
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
            ->markdown('mails.admin.orders.card-not-accepted')
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
