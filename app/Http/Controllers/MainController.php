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
use App\Http\Traits\LinkTrait;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    use LinkTrait;

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
            $product->scheda_tecnica_en = Utility::check_img($product->scheda_tecnica_en);
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
            'links' => [
                'scuola' => $this->format_link(collect(), 1),
                'storia' => $this->format_link(collect(), 2),
                'vini' => $this->format_link(collect(), 3),
                'contatti' => $this->format_link(collect(), 4),
            ]
        ];



        $headerScuola = [
            'title' => $options[2]->value,
            'title_en' => $options[43]->value,
            'txt' => null,
            'img' => Utility::check_img($options[1]->value),
            'alt' => $options[57]->value,
            'alt_en' => $options[58]->value,
            'image_title' => $options[55]->value,
            'image_title_en' => $options[56]->value,
        ];

        $project = [
            'title' => $options[3]->value,
            'title_en' => $options[37]->value,
            'txt' => $options[4]->value,
            'txt_en' => $options[38]->value,
            'img' => Utility::check_img($options[5]->value),
            'alt' => $options[61]->value,
            'alt_en' => $options[62]->value,
            'image_title' => $options[59]->value,
            'image_title_en' => $options[60]->value,
        ];

        $project = $this->format_link($project, 5);

        $family = [
            'title' => $options[6]->value,
            'title_en' => $options[39]->value,
            'txt' => $options[7]->value,
            'txt_en' => $options[40]->value,
            'img' => Utility::check_img($options[8]->value),
            'alt' => $options[65]->value,
            'alt_en' => $options[66]->value,
            'image_title' => $options[63]->value,
            'image_title_en' => $options[64]->value,
        ];

        $family = $this->format_link($family, 6);

        $agriturismo = [
            'title' => $options[9]->value,
            'title_en' => $options[41]->value,
            'txt' => $options[10]->value,
            'txt_en' => $options[42]->value,
            'img' => Utility::check_img($options[11]->value),
            'alt' => $options[69]->value,
            'alt_en' => $options[70]->value,
            'image_title' => $options[67]->value,
            'image_title_en' => $options[68]->value,
        ];

        $agriturismo = $this->format_link($agriturismo, 7);


        $headerStoria = [
            'video' => Utility::check_img($options[12]->value),
        ];

        $scuola = [
            'title' => $options[13]->value,
            'title_en' => $options[44]->value,
            'txt' => $options[14]->value,
            'txt_en' => $options[45]->value,
            'img' => Utility::check_img($options[15]->value),
            'alt' => $options[71]->value,
            'alt_en' => $options[72]->value,
            'image_title' => $options[73]->value,
            'image_title_en' => $options[74]->value,
        ];

        $imageStoria1 = [
            'img' => Utility::check_img($options[16]->value),
            'alt' => $options[75]->value,
            'alt_en' => $options[76]->value,
            'image_title' => $options[77]->value,
            'image_title_en' => $options[78]->value,
        ];

        $imageStoria2 = [
            'img' => Utility::check_img($options[17]->value),
            'alt' => $options[79]->value,
            'alt_en' => $options[80]->value,
            'image_title' => $options[81]->value,
            'image_title_en' => $options[82]->value,
        ];

        $imageStoria3 = [
            'img' => Utility::check_img($options[18]->value),
            'alt' => $options[83]->value,
            'alt_en' => $options[84]->value,
            'image_title' => $options[85]->value,
            'image_title_en' => $options[86]->value,
        ];

        $contatti = [
            'name' => $options[19]->value,
            'address' => $options[20]->value,
            'phone' => $options[21]->value,
            'mail' => $options[22]->value,
            'denominazione' => $options[46]->value,
            'piva' => $options[47]->value,
        ];

        $vini = [
            'title' => $options[23]->value,
            'title_en' => $options[49]->value,
            'txt' => $options[34]->value,
            'txt_en' => $options[48]->value,
            'img' => Utility::check_img($options[24]->value),
            'alt' => $options[87]->value,
            'alt_en' => $options[88]->value,
            'image_title' => $options[89]->value,
            'image_title_en' => $options[90]->value,
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
            'title_en' => $options[90]->value,
            'img' => Utility::check_img($options[32]->value),
            'txt' => $options[33]->value,
            'txt_en' => $options[91]->value,
            'alt' => $options[91]->value,
            'alt_en' => $options[92]->value,
            'image_title' => $options[93]->value,
            'image_title_en' => $options[94]->value,
        ];

        $cookies = [
            'text' => $options[35]->value,
            'text_en' => $options[36]->value,
        ];

        $error = [
            'title' => $options[50]->value,
            'title_en' => $options[52]->value,
            'txt' => $options[51]->value,
            'txt_en' => $options[53]->value,
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
                'image1' => $imageStoria1,
                'image2' => $imageStoria2,
                'image3' => $imageStoria3,
            ],
            'vini' => $vini,
            'contatti' => $contatti,
            'privacy' => $privacy,
            'cookies' => $cookies,
            'error' => $error,
        ];
    }
}
