<?php

namespace App\Http\Controllers\Admin;

use App\Utility;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function get_products() {
        $products = Product::all();

        $products = $this->format_products($products);
        return $products;
    }

    public function destroy(Request $request) {
        $product = Product::find($request->idx);
        $product->delete();

        $products = $this->get_products();
        return $products;
    }

    public function save_product(Request $request) {
        if ($request->is_edit) {
            $product = Product::find($request->idx);

            if ($request->file('icon')) {
                $product->icon = Utility::save_file_for_model($request->file('icon'));
            }

            if ($request->file('scheda_tecnica')) {
                $product->scheda_tecnica = Utility::save_file_for_model($request->file('scheda_tecnica'));
            }

            if ($request->file('scheda_tecnica_en')) {
                $product->scheda_tecnica_en = Utility::save_file_for_model($request->file('scheda_tecnica_en'));
            }

            if($request->file('img')) {
                $product->img = Utility::save_file_for_model($request->file('img'));
            }

        } else {
            $product = new Product();
            $product->icon = Utility::save_file_for_model($request->file('icon'));
            $product->img = Utility::save_file_for_model($request->file('img'));
            $product->scheda_tecnica = Utility::save_file_for_model($request->file('scheda_tecnica'));
        }

        $product->alt = $request->alt;
        $product->alt_en = $request->alt_en;
        $product->image_title = $request->image_title;
        $product->image_title_en = $request->image_title_en;

        $product->title = $request->title;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->vitigno = $request->vitigno;
        $product->zona = $request->zona;
        $product->vinificazione = $request->vinificazione;
        $product->valori_analitici = $request->valori_analitici;

        $product->title_en = $request->title_en;
        $product->short_description_en = $request->short_description_en;
        $product->description_en = $request->description_en;
        $product->vitigno_en = $request->vitigno_en;
        $product->zona_en = $request->zona_en;
        $product->vinificazione_en = $request->vinificazione_en;
        $product->valori_analitici_en = $request->valori_analitici_en;

        $product->multiplier = $request->multiplier;
        $product->price = $request->price;
        $product->is_active = $request->is_active;
        $product->save();

        $product->icon = Utility::check_img($product->icon);
        $product->img = Utility::check_img($product->img);
        $product->scheda_tecnica = Utility::check_img($product->scheda_tecnica);
        $product->scheda_tecnica_en = Utility::check_img($product->scheda_tecnica_en);

        return $product;
    }

    public function format_products($products) {
        $products = $products->transform(function($product, $key) {
            $product->icon = Utility::check_img($product->icon);
            $product->img = Utility::check_img($product->img);
            $product->scheda_tecnica = Utility::check_img($product->scheda_tecnica);
            $product->scheda_tecnica_en = Utility::check_img($product->scheda_tecnica_en);
            return $product;
        });

        return $products;
    }
}
