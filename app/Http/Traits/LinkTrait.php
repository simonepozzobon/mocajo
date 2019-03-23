<?php

namespace App\Http\Traits;

use App\Link;

trait LinkTrait {
    public function save_link($request, $id = false, $page_id) {
        if (!$id) {
            $l = new Link();
        } else {
            $l = Link::find($id);
        }

        $l->page_id = $page_id;
        $l->txt = $request->linktxt;
        $l->txt_en = $request->linktxt_en;
        $l->href = $request->linkhref;
        $l->href_en = $request->linkhref_en;
        $l->save();

        return $l;
    }

    public function save_link_single($linktxt, $linktxt_en, $linkhref = '#', $linkhref_en = '#', $id, $page_id) {
        $l = Link::find($id);
        $l->page_id = $page_id;
        $l->txt = $linktxt;
        $l->txt_en = $linktxt_en;
        $l->href = $linkhref;
        $l->href_en = $linkhref_en;
        $l->save();

        return $l;
    }

    public function get_link($id) {
        $l = Link::find($id);
        return $l;
    }

    public function format_link($prop, $id) {
        $l = Link::find($id);
        $prop['linktxt'] = $l->txt;
        $prop['linktxt_en'] = $l->txt_en;
        $prop['linkhref'] = $l->href;
        $prop['linkhref_en'] = $l->href_en;

        return $prop;
    }
}
