<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Options;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ScuolaMocajoController extends Controller
{
    public function get() {
        $page = Page::find(2);
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

        switch ($request->type) {
            case 'header':
                $options[1] = Utility::save_option($options[1], $request->title);
                $options[0] = Utility::save_file($options[0], $request->file('img'));
                break;
            case 'project':
                $options[2] = Utility::save_option($options[2], $request->title);
                $options[3] = Utility::save_option($options[3], $request->txt);
                $options[4] = Utility::save_file($options[4], $request->file('img'));
                break;
            case 'family':
                $options[5] = Utility::save_option($options[5], $request->title);
                $options[6] = Utility::save_option($options[6], $request->txt);
                $options[7] = Utility::save_file($options[7], $request->file('img'));
                break;
            case 'agriturismo':
                $options[8] = Utility::save_option($options[8], $request->title);
                $options[9] = Utility::save_option($options[9], $request->txt);
                $options[10] = Utility::save_file($options[10], $request->file('img'));
                break;
        }

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function format_options($options) {
        $header = [
            'title' => $options[1]->value,
            'txt' => null,
            'img' => Utility::check_img($options[0]->value),
        ];

        $project = [
            'title' => $options[2]->value,
            'txt' => $options[3]->value,
            'img' => Utility::check_img($options[4]->value),
        ];

        $family = [
            'title' => $options[5]->value,
            'txt' => $options[6]->value,
            'img' => Utility::check_img($options[7]->value),
        ];

        $agriturismo = [
            'title' => $options[8]->value,
            'txt' => $options[9]->value,
            'img' => Utility::check_img($options[10]->value),
        ];

        return [
            'header' => $header,
            'project' => $project,
            'family' => $family,
            'agriturismo' => $agriturismo,
        ];
    }
}
