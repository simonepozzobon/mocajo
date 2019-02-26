<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Utility extends Model
{
    public static function save_file($option, $file) {
        if (isset($file)) {
            $filename = $file->getClientOriginalName();
            $img = $file->storeAs('public/files', $filename);
            $option->value = $img;
            $option->save();
            return $option;
        }
        return $option;
    }

    public static function save_option($option, $value) {
        if (isset($value)) {
            $option->value = $value;
            $option->save();
            return $option;
        }
        return $option;
    }

    public static function check_img($value) {
        if (isset($value) && $value) {
            return Storage::disk('local')->url($value);
        }
        return '';
    }
}
