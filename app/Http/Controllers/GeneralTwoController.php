<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralTwoController extends Controller
{
    public function index() {
        return view('general.two');
    }
}
