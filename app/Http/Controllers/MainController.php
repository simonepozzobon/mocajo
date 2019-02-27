<?php

namespace App\Http\Controllers;

use App\Shop;
use App\City;
use App\Cookie;
use App\Option;
use App\Utility;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index($slug = null) {
        $cities = City::with('shops')->get();
        $options = Option::all();
        $options = $this->format_options($options);
        $options = json_encode($options);

        $products = Product::all();
        $products = $products->transform(function($product, $key) {
            $product->icon = Utility::check_img($product->icon);
            $product->img = Utility::check_img($product->img);
            $product->scheda_tecnica = Utility::check_img($product->scheda_tecnica);
            return $product;
        });

        $products = json_encode($products);

        return view('welcome', compact('cities', 'options', 'products'));
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
            'video' => Utility::check_img($options[0]->value),
        ];

        $headerScuola = [
            'title' => $options[2]->value,
            'txt' => null,
            'img' => Utility::check_img($options[1]->value),
        ];

        $project = [
            'title' => $options[3]->value,
            'txt' => $options[4]->value,
            'img' => Utility::check_img($options[5]->value),
        ];

        $family = [
            'title' => $options[6]->value,
            'txt' => $options[7]->value,
            'img' => Utility::check_img($options[8]->value),
        ];

        $agriturismo = [
            'title' => $options[9]->value,
            'txt' => $options[10]->value,
            'img' => Utility::check_img($options[11]->value),
        ];

        $headerStoria = [
            'video' => Utility::check_img($options[12]->value),
        ];

        $scuola = [
            'title' => $options[13]->value,
            'txt' => $options[14]->value,
            'img' => Utility::check_img($options[15]->value),
        ];

        $imagesStoria = [
            'img1' => Utility::check_img($options[16]->value),
            'img2' => Utility::check_img($options[17]->value),
            'img3' => Utility::check_img($options[18]->value),
        ];

        $contatti = [
            'name' => $options[19]->value,
            'address' => $options[20]->value,
            'phone' => $options[21]->value,
            'mail' => $options[22]->value,
        ];

        $vini = [
            'title' => $options[23]->value,
            'img' => Utility::check_img($options[24]->value),
        ];

        $menu = [
            'scuola' => $options[27]->value,
            'storia' => $options[28]->value,
            'vini' => $options[29]->value,
            'contatti' => $options[30]->value,
        ];

        return [
            'menu' => $menu,
            'home' => $home,
            'scuola' => [
                'header' => $headerScuola,
                'project' => $project,
                'family' => $family,
                'agriturismo' => $agriturismo,
            ],
            'storia' => [
                'header' => $headerStoria,
                'scuola' => $scuola,
                'images' => $imagesStoria,
            ],
            'vini' => $vini,
            'contatti' => $contatti,
        ];
    }
}
