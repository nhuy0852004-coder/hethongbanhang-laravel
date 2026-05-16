<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class TrangchuController extends Controller
{
    public function index()
    {
        return view('website.trangchu.index');
    }
}