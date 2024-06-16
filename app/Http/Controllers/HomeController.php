<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function shop()
    {
        return view('pages.shop');
    }

    public function singleCake(string $id)
    {
        return view('pages.singleCake');
    }
}
