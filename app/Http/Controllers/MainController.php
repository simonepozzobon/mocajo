<?php

namespace App\Http\Controllers;

use App\Seo;
use App\Page;
use App\Shop;
use App\City;
use App\Cookie;
use App\Option;
use App\Utility;
use App\Product;
use App\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index($slug = null) {
        if ($slug) {
            $page = Page::where('slug', $slug)->first();
        } else {
            $page = Page::find(1);
        }

        if (!$page) {
            $page = Page::find(1);
        }

        $seo = $page->seos()->first();

        if (!$seo) {
            $seo = Seo::first();
        }

        $seo->current_url = url()->current();

        $options = Option::all();

        switch ($page->id) {
            case 1:
                $seo->image = Utility::check_img($options[1]->value);
                break;
            case 2:
                $seo->image = Utility::check_img($options[1]->value);
                break;
            case 3:
                $seo->image = Utility::check_img($options[16]->value);
                break;
            case 4:
                $seo->image = Utility::check_img($options[1]->value);
                break;
            case 5:
                $seo->image = Utility::check_img($options[24]->value);
                break;
            case 7:
                $seo->image = Utility::check_img($options[32]->value);
                break;
            default:
                $seo->image = Utility::check_img($options[1]->value);
                break;
        }


        $cities = City::with('shops')->get();
        $options = Option::all();
        $options = $this->format_options($options);
        $options = json_encode($options);

        $shippings = Shipping::all();
        $shippings = $shippings->transform(function($s, $key) {
            $s->logo = Utility::check_img($s->logo);
            return $s;
        });
        $shippings = json_encode($shippings);

        $products = Product::all();
        $products = $products->transform(function($product, $key) {
            $product->icon = Utility::check_img($product->icon);
            $product->img = Utility::check_img($product->img);
            $product->scheda_tecnica = Utility::check_img($product->scheda_tecnica);
            return $product;
        });

        $products = json_encode($products);

        return view('welcome', compact('cities', 'options', 'products', 'seo', 'shippings'));
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
            'txt' => $options[34]->value,
            'img' => Utility::check_img($options[24]->value),
        ];

        $shop = [
            'active' => $options[25]->value == 'true' ? true : false,
            'multiplier' => $options[26]->value,
        ];

        $menu = [
            'scuola' => $options[27]->value,
            'storia' => $options[28]->value,
            'vini' => $options[29]->value,
            'contatti' => $options[30]->value,
        ];

        $privacy = [
            'title' => $options[31]->value,
            'img' => Utility::check_img($options[32]->value),
            'txt' => $options[33]->value,
        ];

        return [
            'menu' => $menu,
            'shop' => $shop,
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
            'privacy' => $privacy,
        ];
    }
}
