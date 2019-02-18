<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    public function shops() {
        return $this->hasMany(Shop::class);
    }
}
