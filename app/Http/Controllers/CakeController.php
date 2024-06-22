<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\CakeVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = CakeVariant::all();
        $cakes = Cake::orderBy('id', 'desc')->get();
        return view('admin.pages.cakes', [
            'variants' => $variants,
            'cakes' => $cakes
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
            'cake_variant_id' => 'required|string|max:255',
            'images' => 'required',
            'images.*' => 'mimetypes:image/jpg,image/jpeg,image/png|max:2040',
            'price' => 'required|numeric|min:0'
        ], [
            'images.required' => 'Please choose an image.',
            'images.*.mimes' => 'The image field must be a file of type: jpeg, png, jpg.',
            'images.*.max' => 'The image should not exceed 2mb',
            'cake_variant_id.required' => 'Variant field is required'
        ]);

        try {
            DB::beginTransaction();
            $cake = Cake::create($request->except(['images']));
            $images = $request->file('images');

            foreach ($images as $key => $image) {
                $file_name = time() . $image->getClientOriginalName();
                $path =  '/cake_images';
                $image->move(public_path() . '/' . $path,  $file_name);

                $cake->images()->create([
                    'path' => $path . '/' . $file_name
                ]);
            }
            DB::commit();
            return back()->with('success', 'Cake add successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Try again');
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
