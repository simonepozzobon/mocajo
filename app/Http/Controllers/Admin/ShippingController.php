<?php

namespace App\Http\Controllers\Admin;

use App\Utility;
use App\Shipping;
use App\ShipVariation;
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
        // $shipping->description_en = $request->description_en;
        $shipping->default = $request->default;
        $shipping->increment = $request->increment;
        $shipping->timing = $request->timing;
        $shipping->save();

        $variations = json_decode($request->variations);
        $old_vars = $shipping->variations()->delete();

        foreach ($variations as $key => $variation) {
            $var = new ShipVariation();
            $var->shipping_id = $shipping->id;
            if ($variation->left === 0 || ($variation->left != null && $variation->left != '')) {
                $var->left = $variation->left;
            }
            $var->operator = $variation->operator;
            $var->right = $variation->right;
            $var->price = $variation->price;
            $var->save();
        }

        $shippings = $this->get();
        $shippings_formatted = $this->format_shippings($shippings);
        return $shippings_formatted;
    }

    public function format_shippings($shippings) {
        $shippings = $shippings->transform(function($s, $key) {
            $s->logo = Utility::check_img($s->logo);
            $s->variations = $s->variations;
            return $s;
        });

        return $shippings;
    }
}
