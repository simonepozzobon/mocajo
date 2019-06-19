<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public function order() {
        return $this->hasMany(Order::class);
    }

    public function variations() {
        return $this->hasMany(ShipVariation::class);
    }
}
