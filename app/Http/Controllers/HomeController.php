<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\CakeVariant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
}
