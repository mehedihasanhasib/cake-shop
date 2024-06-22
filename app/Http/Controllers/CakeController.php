<?php

namespace App\Http\Controllers;

use App\Models\CakeVariant;
use Illuminate\Http\Request;

class CakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = CakeVariant::all();
        return view('admin.pages.cakes', [
            'variants' => $variants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'variant' => 'required|string|max:255',
            'images' => 'required',
            'images.*' => 'mimetypes:image/jpg,image/jpeg,image/png|max:2040',
            'price' => 'required|numeric|min:0'
        ], [
            'images.required' => 'Please choose an image.',
            'images.*.mimes' => 'The image field must be a file of type: jpeg, png, jpg.',
            'images.*.max' => 'The image should not exceed 2mb',
        ]);

        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
