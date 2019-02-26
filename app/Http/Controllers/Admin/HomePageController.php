<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Options;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{
    public function post_video(Request $request) {
        $filename = $request->file('video')->getClientOriginalName();
        $video = $request->file('video')->storeAs('public/files', $filename);

        $page = Page::find(1);
        $options = $page->options;
        $option = $options[0];
        $option->value = $video;
        $option->save();
        return [
            'option' => $option,
        ];
    }

    public function get_video(Request $request) {
        $page = Page::find(1);
        $options = $page->options;
        $option = $options[0];
        $value = Storage::disk('local')->url($option->value);

        return $value;
    }
}
