<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';

    public function city() {
        return $this->belongsTo(City::class);
    }
}
