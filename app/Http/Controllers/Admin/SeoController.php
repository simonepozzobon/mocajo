<?php

namespace App\Http\Controllers\Admin;

use App\Seo;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    public function get_page_seo($id) {
        $page = Page::find($id);
        $seo = $page->seos()->first();

        return $seo;
    }

    public function save_seo(Request $request) {
        if ($request->idx) {
            $seo = Seo::find($request->idx);
        } else {
            $seo = new Seo();
        }

        $seo->page_id = $request->page_id;
        $seo->title = $request->title;
        $seo->title_en = $request->title_en;
        $seo->description = $request->description;
        $seo->description_en = $request->description_en;
        $seo->save();

        return $seo;
    }
}
