<?php

namespace App\Http\Controllers;

use App\Models\CakeVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                'variant_name.required' => 'Variant name field can\'t be null'
            ]
        );

        try {
            CakeVariant::create($validated_data);
            return back()->with('success', 'Variant add successful');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return back()->with('error', 'Something went wrong');
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
        try {
            if ($request->has('variant_name')) {
                $validated_data = $request->validate([
                    'variant_name' => 'string|max:255'
                ]);
                CakeVariant::where('id', $id)->update($validated_data);
                return back()->with('success', 'Variant update successful');
            } else {
                return back()->with('info', 'No new valuNothing Updated');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
