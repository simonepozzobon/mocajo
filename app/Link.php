<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    public function page() {
        return $this->belongsTo(Page::class);
    }
}
