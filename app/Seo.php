<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    public function page() {
        return $this->belongsTo(Page::class);
    }
}
