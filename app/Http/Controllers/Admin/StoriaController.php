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
                $options[7] = Utility::save_option($options[7], $request->title_en);
                $options[8] = Utility::save_option($options[8], $request->txt_en);
                $options[3] = Utility::save_file($options[3], $request->file('img'));
                $options[9] = Utility::save_option($options[9], $request->alt);
                $options[10] = Utility::save_option($options[10], $request->alt_en);
                $options[11] = Utility::save_option($options[11], $request->image_title);
                $options[12] = Utility::save_option($options[12], $request->image_title_en);
                break;
            case 'image-1':
                $options[4] = Utility::save_file($options[4], $request->file('img'));
                $options[13] = Utility::save_option($options[13], $request->alt);
                $options[14] = Utility::save_option($options[14], $request->alt_en);
                $options[15] = Utility::save_option($options[15], $request->image_title);
                $options[16] = Utility::save_option($options[16], $request->image_title_en);
                break;
            case 'image-2':
                $options[5] = Utility::save_file($options[5], $request->file('img'));
                $options[17] = Utility::save_option($options[17], $request->alt);
                $options[18] = Utility::save_option($options[18], $request->alt_en);
                $options[19] = Utility::save_option($options[19], $request->image_title);
                $options[20] = Utility::save_option($options[20], $request->image_title_en);
                break;
            case 'image-3':
                $options[6] = Utility::save_file($options[6], $request->file('img'));
                $options[21] = Utility::save_option($options[21], $request->alt);
                $options[22] = Utility::save_option($options[22], $request->alt_en);
                $options[23] = Utility::save_option($options[23], $request->image_title);
                $options[24] = Utility::save_option($options[24], $request->image_title_en);
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
            'alt' => $options[9]->value,
            'alt_en' => $options[10]->value,
            'image_title' => $options[11]->value,
            'image_title_en' => $options[12]->value,
        ];

        $image1 = [
            'img' => Utility::check_img($options[4]->value),
            'alt' => $options[13]->value,
            'alt_en' => $options[14]->value,
            'image_title' => $options[15]->value,
            'image_title_en' => $options[16]->value,
        ];

        $image2 = [
            'img' => Utility::check_img($options[5]->value),
            'alt' => $options[17]->value,
            'alt_en' => $options[18]->value,
            'image_title' => $options[19]->value,
            'image_title_en' => $options[20]->value,
        ];

        $image3 = [
            'img' => Utility::check_img($options[6]->value),
            'alt' => $options[21]->value,
            'alt_en' => $options[22]->value,
            'image_title' => $options[23]->value,
            'image_title_en' => $options[24]->value,
        ];

        return [
            'header' => $header,
            'scuola' => $scuola,
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
        ];
    }
}
