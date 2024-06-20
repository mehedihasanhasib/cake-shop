<?php

namespace App\Http\Controllers;

use App\Models\CakeVariant;
use Illuminate\Http\Request;

class CakeVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = CakeVariant::all();

        return view('admin.pages.cakeVariants', [
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
        $validated_data = $request->validate(
            [
                'variant_name' => 'required|string|max:255'
            ],
            [
                'variant_name.required' => 'Variant field can\'t be null'
            ]
        );

        try {
            CakeVariant::create($validated_data);

            return back()->with('success', 'Variant add successful');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
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
