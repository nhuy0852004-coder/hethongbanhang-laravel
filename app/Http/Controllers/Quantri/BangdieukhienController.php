<?php

namespace App\Http\Controllers\Quantri;

use App\Http\Controllers\Controller;

class BangdieukhienController extends Controller
{
    public function index()
    {
        return view('quantri.bangdieukhien.index');
    }
}