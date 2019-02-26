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
}
