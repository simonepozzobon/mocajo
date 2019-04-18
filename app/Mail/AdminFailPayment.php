<?php

namespace App\Mail;

use App\Order;
use App\Mail\DebugPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class AdminFailPayment extends Mailable
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

        $this->sender = env('SHOP_MAIL', 'info@scuolamocajo.it');
        $this->lang = 'ita';
        $this->subject = 'Nuovo ordine - pagamento fallito';

        $this->items = $order->products->transform(function($product, $key) {
            $item = array();
            // $item['title'] = $product->title;
            // $item['quantity'] = $product->pivot->quantity;
            // $item['price'] = $product->price;
            // $item['pricetot'] = $product->price * $product->pivot->quantity;
            $item['title'] = 'title';
            $item['quantity'] = 4;
            $item['price'] = 10.00;
            $item['pricetot'] = 12.00;
            return $item;
        });
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
            ->markdown('mails.client.orders.fail')
            ->with([
                'customer' => $this->customer,
                'order' => $this->order,
                'items' => $this->items,
                'amount' => $this->amount,
                'lang' => $this->lang,
            ]);
    }
}
