<?php

namespace App\Console\Commands;

use App\Product;
use Cartalyst\Stripe\Stripe;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SetProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store Products on Stripe';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $products = Product::all();

        $stripe = $this->connect();
        foreach ($products as $key => $product) {
            if (!$product->stripe_id) {
                $url = env('APP_URL').Storage::disk('local')->url($product->img);
                $stripe_product = $stripe->products()->create([
                    'name' => $product->title,
                    'caption' => $product->short_description,
                    'description' => $product->description,
                    'images' => [$url],
                    'url' => env('APP_URL').'/it/vini',
                ]);
                $product->stripe_id = $stripe_product['id'];

                $sku = $stripe->skus()->create([
                    'product' => $stripe_product['id'],
                    'price' => $product->price,
                    'currency' => 'eur',
                    'inventory' => [
                        'type' => 'infinite',
                    ],
                ]);
                $product->sku_id = $sku['id'];
                $product->save();

                $this->line('prodotto '. $stripe_product['id']);
                $this->line('sku '.$sku['id']);
            }
        }

        $this->info('Completed');
    }

    public function connect() {
        $key = env('PUBLISHABLE_KEY', '');
        $secret = env('SECRET_KEY', '');
        $stripe = Stripe::make($key);
        $stripe->setApiKey($secret);
        return $stripe;
    }
}
