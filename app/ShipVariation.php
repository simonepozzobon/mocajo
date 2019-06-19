<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipVariation extends Model
{
    protected $table = 'ship_variations';

    public function shipping() {
        return $this->belongsTo(Shipping::class);
    }
}
