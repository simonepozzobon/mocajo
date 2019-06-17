<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function status_code() {
        return $this->belongsTo(StatusCode::class);
    }

    public function shipping() {
        return $this->belongsTo(Shipping::class);
    }
}
