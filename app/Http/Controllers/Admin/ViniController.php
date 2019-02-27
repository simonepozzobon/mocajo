<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Options;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViniController extends Controller
{
    public function get() {
        $page = Page::find(5);
        $options = $page->options;
        return $options;
    }

    public function get_options(Request $request) {
        $options = $this->get();

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function save_section(Request $request) {
        $options = $this->get();

        $options[0] = Utility::save_option($options[0], $request->title);
        $options[1] = Utility::save_file($options[1], $request->file('img'));

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function format_options($options) {
        $header = [
            'title' => $options[0]->value,
            'txt' => null,
            'img' => Utility::check_img($options[1]->value),
        ];

        return [
            'header' => $header,
        ];
    }
}
