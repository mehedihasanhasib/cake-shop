<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\CakeVariant;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $cakes = Cake::orderBy('id', 'desc')->paginate(12);
        $variants = CakeVariant::all();
        return view('pages.shop', compact('cakes', 'variants'));
    }

    public function singleCake(string $id)
    {
        return view('pages.singleCake');
    }

    public function search_by_category(string $slug)
    {
        $variant = CakeVariant::where('slug', $slug)->first();
        dd($variant->cakes);
    }
}
