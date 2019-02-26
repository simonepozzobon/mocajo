<?php

namespace App\Http\Controllers;

use App\Shop;
use App\City;
use App\Cookie;
use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index($slug = null) {
        $cities = City::with('shops')->get();
        $options = Option::all();
        $options = $this->format_options($options);
        $options = json_encode($options);

        return view('welcome', compact('cities', 'options'));
    }

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

    public function check_img($value) {
        if (isset($value) && $value) {
            return Storage::disk('local')->url($value);
        }
        return '';
    }

    public function format_options($options) {
        $home = [
            'video' => $this->check_img($options[0]->value),
        ];

        $headerScuola = [
            'title' => $options[2]->value,
            'txt' => null,
            'img' => $this->check_img($options[1]->value),
        ];

        $project = [
            'title' => $options[3]->value,
            'txt' => $options[4]->value,
            'img' => $this->check_img($options[5]->value),
        ];

        $family = [
            'title' => $options[6]->value,
            'txt' => $options[7]->value,
            'img' => $this->check_img($options[8]->value),
        ];

        $agriturismo = [
            'title' => $options[9]->value,
            'txt' => $options[10]->value,
            'img' => $this->check_img($options[11]->value),
        ];

        return [
            'home' => $home,
            'scuola' => [
                'header' => $headerScuola,
                'project' => $project,
                'family' => $family,
                'agriturismo' => $agriturismo,
            ],
        ];
    }
}
