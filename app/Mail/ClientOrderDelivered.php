<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientOrderDelivered extends Mailable
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
            $this->items = $this->set_items($order);
            $this->sender = env('SHOP_MAIL', 'info@scuolamocajo.it');
            $this->lang = 'ita';
            $this->subject = 'Scuola Mocajo - Ordine Consegnato';
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
                ->markdown('mails.client.orders.delivered')
                ->with([
                    'customer' => $this->customer,
                    'order' => $this->order,
                    'items' => $this->items,
                    'amount' => $this->amount,
                    'lang' => $this->lang,
                ]);
        }

        public function set_items($order) {
            $products = $order->products;

            $items = $products->transform(function($product, $key) {
                $item = array();
                $item['title'] = $product->title;
                $item['quantity'] = $product->pivot->quantity;
                $item['price'] = $product->price;
                $item['pricetot'] = $product->price * $product->pivot->quantity;
                return $item;
            });
            return $items;
        }
}
