<?php

namespace App\Http\Controllers\Admin;

use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function get_shops() {
        $shops = Shop::with('city')->get();
        return $shops;
    }

    public function destroy(Request $request) {
        $shop = Shop::find($request->idx);
        $shop->delete();

        $shops = $this->get_shops();
        return $shops;
    }

    public function save_shop(Request $request) {
        if ($request->is_edit) {
            $shop = Shop::find($request->idx);

        } else {
            $shop = new Shop();
        }

        $shop->city_id = $request->city_id;
        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->lat = $request->lat;
        $shop->lng = $request->lng;
        $shop->save();

        $shops = $this->get_shops();
        return $shops;
    }
}
