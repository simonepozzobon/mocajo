<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Options;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    public function get() {
        $page = Page::find(7);
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
        $options[2] = Utility::save_option($options[2], $request->txt);
        $options[3] = Utility::save_option($options[3], $request->title_en);
        $options[4] = Utility::save_option($options[4], $request->txt_en);
        $options[5] = Utility::save_option($options[5], $request->alt);
        $options[6] = Utility::save_option($options[6], $request->alt_en);
        $options[7] = Utility::save_option($options[7], $request->image_title);
        $options[8] = Utility::save_option($options[8], $request->image_title_en);

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function format_options($options) {
        $privacy = [
            'title' => $options[0]->value,
            'txt' => $options[2]->value,
            'img' => Utility::check_img($options[1]->value),
            'txt_en' => $options[4]->value,
            'title_en' => $options[3]->value,
            'alt' => $options[5]->value,
            'alt_en' => $options[6]->value,
            'image_title' => $options[7]->value,
            'image_title_en' => $options[8]->value,
        ];

        return [
            'privacy' => $privacy,
        ];
    }
}
