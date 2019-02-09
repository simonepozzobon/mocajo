<?php

namespace App\Http\Controllers;

use App\Cookie;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function cookies_preferences(Request $request) {
        $ip = \Request::ip();

        $cookie = new Cookie();
        $cookie->ip = $ip ? $ip : 'no-ip';
        $cookie->accepted = 1;
        $cookie->save();

        return [
            'ip' => $ip,
        ];
    }
}
