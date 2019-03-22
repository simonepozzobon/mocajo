<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Options;
use App\Utility;
use App\Http\Traits\LinkTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ScuolaMocajoController extends Controller
{

    use LinkTrait;

    public function __construct() {
        $this->page_id = 2;
    }

    public function get() {
        $page = Page::find($this->page_id);
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
                $options[17] = Utility::save_option($options[17], $request->title_en);
                $options[0] = Utility::save_file($options[0], $request->file('img'));
                $options[18] = Utility::save_option($options[18], $request->alt);
                $options[19] = Utility::save_option($options[19], $request->alt_en);
                $options[20] = Utility::save_option($options[20], $request->image_title);
                $options[21] = Utility::save_option($options[21], $request->image_title_en);

                break;
            case 'project':
                $options[2] = Utility::save_option($options[2], $request->title);
                $options[3] = Utility::save_option($options[3], $request->txt);
                $options[11] = Utility::save_option($options[11], $request->title_en);
                $options[12] = Utility::save_option($options[12], $request->txt_en);
                $options[4] = Utility::save_file($options[4], $request->file('img'));
                $options[22] = Utility::save_option($options[22], $request->alt);
                $options[23] = Utility::save_option($options[23], $request->alt_en);
                $options[24] = Utility::save_option($options[24], $request->image_title);
                $options[25] = Utility::save_option($options[25], $request->image_title_en);

                $this->save_link($request, 5, $this->page_id);

                break;
            case 'family':
                $options[5] = Utility::save_option($options[5], $request->title);
                $options[6] = Utility::save_option($options[6], $request->txt);
                $options[13] = Utility::save_option($options[13], $request->title_en);
                $options[14] = Utility::save_option($options[14], $request->txt_en);
                $options[7] = Utility::save_file($options[7], $request->file('img'));
                $options[26] = Utility::save_option($options[26], $request->alt);
                $options[27] = Utility::save_option($options[27], $request->alt_en);
                $options[28] = Utility::save_option($options[28], $request->image_title);
                $options[29] = Utility::save_option($options[29], $request->image_title_en);

                $this->save_link($request, 6, $this->page_id);

                break;
            case 'agriturismo':
                $options[8] = Utility::save_option($options[8], $request->title);
                $options[9] = Utility::save_option($options[9], $request->txt);
                $options[15] = Utility::save_option($options[15], $request->title_en);
                $options[16] = Utility::save_option($options[16], $request->txt_en);
                $options[10] = Utility::save_file($options[10], $request->file('img'));
                $options[30] = Utility::save_option($options[30], $request->alt);
                $options[31] = Utility::save_option($options[31], $request->alt_en);
                $options[32] = Utility::save_option($options[32], $request->image_title);
                $options[33] = Utility::save_option($options[33], $request->image_title_en);

                $this->save_link($request, 7, $this->page_id);

                break;
        }

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function format_options($options) {
        $header = [
            'title' => $options[1]->value,
            'txt' => null,
            'title_en' => $options[17]->value,
            'txt_en' => null,
            'img' => Utility::check_img($options[0]->value),
            'alt' => $options[18]->value,
            'alt_en' => $options[19]->value,
            'image_title' => $options[20]->value,
            'image_title_en' => $options[21]->value,
        ];

        $project = [
            'title' => $options[2]->value,
            'txt' => $options[3]->value,
            'title_en' => $options[11]->value,
            'txt_en' => $options[12]->value,
            'img' => Utility::check_img($options[4]->value),
            'alt' => $options[22]->value,
            'alt_en' => $options[23]->value,
            'image_title' => $options[24]->value,
            'image_title_en' => $options[25]->value,
        ];

        $project = $this->format_link($project, 5);

        $family = [
            'title' => $options[5]->value,
            'txt' => $options[6]->value,
            'title_en' => $options[13]->value,
            'txt_en' => $options[14]->value,
            'img' => Utility::check_img($options[7]->value),
            'alt' => $options[26]->value,
            'alt_en' => $options[27]->value,
            'image_title' => $options[28]->value,
            'image_title_en' => $options[29]->value,
        ];

        $family = $this->format_link($family, 6);

        $agriturismo = [
            'title' => $options[8]->value,
            'txt' => $options[9]->value,
            'title_en' => $options[15]->value,
            'txt_en' => $options[16]->value,
            'img' => Utility::check_img($options[10]->value),
            'alt' => $options[30]->value,
            'alt_en' => $options[31]->value,
            'image_title' => $options[32]->value,
            'image_title_en' => $options[33]->value,
        ];

        $agriturismo = $this->format_link($agriturismo, 7);

        return [
            'header' => $header,
            'project' => $project,
            'family' => $family,
            'agriturismo' => $agriturismo,
        ];
    }
}
