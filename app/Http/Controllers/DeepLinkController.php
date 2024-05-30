<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeepLinkController extends Controller
{
    public function index() {
        echo "<pre>";
        // print_r($_COOKIE);
        print_r($_SERVER);
    }
}
