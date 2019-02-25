<?php

namespace App\Http\Controllers;

use App\Page;
use App\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index($slug = null) {
        return view('admin.index');
    }

    public function homepage_post_video(Request $request) {

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

    public function homepage_get_video(Request $request) {
        $page = Page::find(1);
        $options = $page->options;
        $option = $options[0];
        $value = Storage::disk('local')->url($option->value);

        return $value;
    }
}
