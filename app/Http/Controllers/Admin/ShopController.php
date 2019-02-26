<?php

namespace App\Http\Controllers\Admin;

use App\Shop;
use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function get_shops() {
        $shops = Shop::with('city')->get();
        return $shops;
    }

    public function get_cities() {
        $cities = City::all();
        return $cities;
    }

    public function destroy(Request $request) {
        $shop = Shop::find($request->idx);
        $shop->delete();

        $shops = $this->get_shops();
        return $shops;
    }

    public function city_destroy(Request $request) {
        $city = City::find($request->idx);
        $city->delete();

        $cities = $this->get_cities();
        return $cities;
    }

    public function save_city(Request $request) {
        if ($request->is_edit) {
            $city = City::find($request->idx);

        } else {
            $city = new City();
        }

        $city->name = $request->name;
        $city->lat = $request->lat;
        $city->lng = $request->lng;
        $city->save();

        $cities = $this->get_cities();
        return $cities;
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
