<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Options;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ScuolaMocajoController extends Controller
{
    public function get_options(Request $request) {
        $page = Page::find(2);
        $options = $page->options;

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function save_section(Request $request) {
        $page = Page::find(2);
        $options = $page->options;

        switch ($request->type) {
            case 'header':
                $options[1] = $this->save_option($options[1], $request->title);
                $options[0] = $this->save_img($options[0], $request->file('img'));
                break;
            case 'project':
                $options[2] = $this->save_option($options[2], $request->title);
                $options[3] = $this->save_option($options[3], $request->txt);
                $options[4] = $this->save_img($options[4], $request->file('img'));
                break;
            case 'family':
                $options[5] = $this->save_option($options[5], $request->title);
                $options[6] = $this->save_option($options[6], $request->txt);
                $options[7] = $this->save_img($options[7], $request->file('img'));
                break;
            case 'agriturismo':
                $options[8] = $this->save_option($options[8], $request->title);
                $options[9] = $this->save_option($options[9], $request->txt);
                $options[10] = $this->save_img($options[10], $request->file('img'));
                break;
        }

        $options_formatted = $this->format_options($options);
        return $options_formatted;
    }

    public function save_img($option, $file) {
        if (isset($file)) {
            $filename = $file->getClientOriginalName();
            $img = $file->storeAs('public/files', $filename);
            $option->value = $img;
            $option->save();
            return $option;
        }
        return $option;
    }

    public function save_option($option, $value) {
        if (isset($value)) {
            $option->value = $value;
            $option->save();
            return $option;
        }
        return $option;
    }

    public function check_img($value) {
        if (isset($value) && $value) {
            return Storage::disk('local')->url($value);
        }
        return '';
    }

    public function format_options($options) {
        $header = [
            'title' => $options[1]->value,
            'txt' => null,
            'img' => $this->check_img($options[0]->value),
        ];

        $project = [
            'title' => $options[2]->value,
            'txt' => $options[3]->value,
            'img' => $this->check_img($options[4]->value),
        ];

        $family = [
            'title' => $options[5]->value,
            'txt' => $options[6]->value,
            'img' => $this->check_img($options[7]->value),
        ];

        $agriturismo = [
            'title' => $options[8]->value,
            'txt' => $options[9]->value,
            'img' => $this->check_img($options[10]->value),
        ];

        return [
            'header' => $header,
            'project' => $project,
            'family' => $family,
            'agriturismo' => $agriturismo,
        ];
    }
}
