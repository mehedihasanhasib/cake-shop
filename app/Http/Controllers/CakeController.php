<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\CakeVariant;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
            'price' => 'required|numeric'
        ], [
            'images.required' => 'Please choose an image',
            'images.*.mimetypes' => 'The image field must be type of: jpeg, png, jpg',
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
        // dd($request->hasFile('updated_images'));
        $request->validate([
            'name' => 'required|string|max:255',
            'cake_variant_id' => 'required|string|max:255',
            'updated-images.*' => 'mimetypes:image/jpg,image/jpeg,image/png|max:2040',
            'price' => 'required|numeric|min:0'
        ], [
            'updated-images.*.mimetypes' => 'The image field must be a file of type: jpeg, png, jpg.',
            'updated-images.*.max' => 'The image should not exceed 2mb',
            'cake_variant_id.required' => 'Variant field is required'
        ]);

        // try {
            $old_cake = Cake::select(['name', 'cake_variant_id', 'price'])->find($id)->toArray();

            if (!$old_cake) {
                return back()->with('error', 'Cake not found');
            }

            $new_cake = $request->only(['name', 'cake_variant_id', 'price']);

            $updated_part = array_diff($new_cake, $old_cake);

            if($updated_part){

                Cake::where('id', $id)->update($updated_part);

            } else if($request->hasFile('updated_images')){
                $images = $request->updated_images;
                foreach ($images as $key => $image) {
                    $file_name = time() . $image->getClientOriginalName();
                    $path =  '/cake_images';
                    $image->move(public_path() . '/' . $path,  $file_name);

                    Image::create([
                        'path' => $path . '/' . $file_name,
                        'cake_id' => $id
                    ]);
                }
    
            } else if (isset($request->imagesToRemove)) {
                $imagesToRemove = json_decode($request->imagesToRemove);
                foreach($imagesToRemove as $id){
                    $deleted_image = Image::find($id);
                    $deleted_image_path = public_path($deleted_image->path);
                    if(File::exists($deleted_image_path)){
                        File::delete($deleted_image_path);                   
                    }
                    Image::destroy($id);
                }
            } else {
                return back()->with('info', 'Nothing to update');
            }

            return back()->with('success', 'Cake update successful');
        // } catch (\Throwable $th) {
        //     dd($th->getMessage());
        //     return back()->with('error', 'Something went wrong. Try again');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd($id);
    }
}
