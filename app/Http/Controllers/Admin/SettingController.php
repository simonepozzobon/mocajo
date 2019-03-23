<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Option;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Traits\LinkTrait;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    use LinkTrait;

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
                $options[2] = $this->save_link_single($request->scuola, $request->scuola_en, '#', '#', 1, 1);
                $options[3] = $this->save_link_single($request->storia, $request->storia_en, '#', '#', 2, 1);
                $options[4] = $this->save_link_single($request->vini, $request->vini_en, '#', '#', 3, 1);
                $options[5] = $this->save_link_single($request->contatti, $request->contatti_en, '#', '#', 4, 1);
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
            'scuola' => $this->get_link(1),
            'storia' => $this->get_link(2),
            'vini' => $this->get_link(3),
            'contatti' => $this->get_link(4),
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
