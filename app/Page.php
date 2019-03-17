<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    public function options() {
        return $this->hasMany(Option::class);
    }

    public function seos() {
        return $this->hasMany(Seo::class);
    }
}
