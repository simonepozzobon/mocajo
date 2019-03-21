<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Option;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function get() {
        $page = Page::find(6);
        $options = $page->options;
        return $options;
    }

    public function get_options() {
        $options = $this->get();
        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function save_section(Request $request) {
        $options = $this->get();
        switch ($request->type) {
            case 'shop':
                $options[0] = Utility::save_option($options[0], $request->active);
                $options[1] = Utility::save_option($options[1], $request->multiplier);
                break;
            case 'menu':
                $options[2] = Utility::save_option($options[2], $request->scuola);
                $options[3] = Utility::save_option($options[3], $request->storia);
                $options[4] = Utility::save_option($options[4], $request->vini);
                $options[5] = Utility::save_option($options[5], $request->contatti);
                break;
            case 'cookies':
                $options[6] = Utility::save_option($options[6], $request->text);
                $options[7] = Utility::save_option($options[7], $request->text_en);
                break;
        }

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function format_options($options) {
        $shop = [
            'active' => $options[0]->value,
            'multiplier' => $options[1]->value,
        ];

        $menu = [
            'scuola' => $options[2]->value,
            'storia' => $options[3]->value,
            'vini' => $options[4]->value,
            'contatti' => $options[5]->value,
        ];

        $cookies = [
            'text' => $options[6]->value,
            'text_en' => $options[7]->value,
        ];

        return [
            'shop' => $shop,
            'menu' => $menu,
            'cookies' => $cookies,
        ];
    }
}
