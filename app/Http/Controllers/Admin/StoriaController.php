<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Options;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StoriaController extends Controller
{
    public function get_options() {
        $page = Page::find(3);
        $options = $page->options;

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function save_section(Request $request) {
        $page = Page::find(3);
        $options = $page->options;

        switch ($request->type) {
            case 'header':
                $options[0] = Utility::save_file($options[0], $request->file('img'));
                break;
            case 'scuola':
                $options[1] = Utility::save_option($options[1], $request->title);
                $options[2] = Utility::save_option($options[2], $request->txt);
                $options[7] = Utility::save_option($options[7], $request->title);
                $options[8] = Utility::save_option($options[8], $request->txt);
                $options[3] = Utility::save_file($options[3], $request->file('img'));
                break;
            case 'image-1':
                $options[4] = Utility::save_file($options[4], $request->file('img'));
                break;
            case 'image-2':
                $options[5] = Utility::save_file($options[5], $request->file('img'));
                break;
            case 'image-3':
                $options[6] = Utility::save_file($options[6], $request->file('img'));
                break;
        }

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function format_options($options) {
        $header = [
            'img' => Utility::check_img($options[0]->value),
        ];

        $scuola = [
            'title' => $options[1]->value,
            'title_en' => $options[7]->value,
            'txt' => $options[2]->value,
            'txt_en' => $options[8]->value,
            'img' => Utility::check_img($options[3]->value),
        ];

        $images = [
            'img1' => Utility::check_img($options[4]->value),
            'img2' => Utility::check_img($options[5]->value),
            'img3' => Utility::check_img($options[6]->value),
        ];

        return [
            'header' => $header,
            'scuola' => $scuola,
            'images' => $images,
        ];
    }
}
