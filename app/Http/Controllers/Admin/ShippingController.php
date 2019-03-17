<?php

namespace App\Http\Controllers\Admin;

use App\Utility;
use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public function get() {
        $shippings = Shipping::all();
        return $shippings;
    }

    public function get_shippings() {
        $shippings = $this->get();
        $shippings_formatted = $this->format_shippings($shippings);

        return $shippings_formatted;
    }

    public function destroy(Request $request) {
        $shipping = Shipping::find($request->idx);
        $shipping->delete();

        $shippings = $this->get();
        $shippings_formatted = $this->format_shippings($shippings);
        return $shippings_formatted;
    }

    public function save_shipping(Request $request) {
        if ($request->is_edit) {
            $shipping = Shipping::find($request->idx);

        } else {
            $shipping = new Shipping();
        }

        if ($request->file('logo')) {
            $shipping->logo = Utility::save_file_for_model($request->file('logo'));
        }

        $shipping->description = $request->description;
        $shipping->default = $request->default;
        $shipping->price = $request->price;
        $shipping->increment = $request->increment;
        $shipping->timing = $request->timing;
        $shipping->save();

        $shippings = $this->get();
        $shippings_formatted = $this->format_shippings($shippings);
        return $shippings_formatted;
    }

    public function format_shippings($shippings) {
        $shippings = $shippings->transform(function($s, $key) {
            $s->logo = Utility::check_img($s->logo);
            return $s;
        });

        return $shippings;
    }
}
