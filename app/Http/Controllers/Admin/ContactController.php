<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Options;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function get_options() {
        $page = Page::find(4);
        $options = $page->options;

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function save_section(Request $request) {
        $page = Page::find(4);
        $options = $page->options;

        $options[0] = Utility::save_option($options[0], $request->name);
        $options[1] = Utility::save_option($options[1], $request->address);
        $options[2] = Utility::save_option($options[2], $request->phone);
        $options[3] = Utility::save_option($options[3], $request->mail);

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function format_options($options) {
        $data = [
            'name' => $options[0]->value,
            'address' => $options[1]->value,
            'phone' => $options[2]->value,
            'mail' => $options[3]->value,
        ];

        return $data;
    }
}
