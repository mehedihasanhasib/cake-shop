<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function shop()
    {
        $cakes = Cake::orderBy('id', 'desc')->paginate(12);
        return view('pages.shop', compact('cakes'));
    }

    public function singleCake(string $id)
    {
        return view('pages.singleCake');
    }
}
