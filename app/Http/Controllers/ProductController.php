<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(4);
        return view('pages.products.index', compact('products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $products = Product::onlyTrashed()->latest()->paginate(4);
        return view('pages.products.trash', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $request->validate([
            'title' => 'required|max:64',
            'price' => 'required|numeric',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'description' => 'nullable',
            'created_by' => 'nullable|max:64',
            'updated_by' => 'nullable|max:64',
            'deleted_by' => 'nullable|max:64',
        ]);

        $imageName = Str::random() . '.' . $request->image->getClientOriginalExtension();
        Storage::disk('public')->putFileAs("images/products/", $request->image , $imageName);

        $product = Product::create( $request->post() + ['image' => $imageName ] );

        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('pages.products.details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('pages.products.update', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|max:64',
            'price' => 'required|numeric',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'description' => 'nullable',
            'created_by' => 'nullable|max:64',
            'updated_by' => 'nullable|max:64',
            'deleted_by' => 'nullable|max:64',
        ]);

        if ($request->hasFile('image')){
            if ($product->image) {
                $exist = Storage::disk('public')->exists("images/products/{$product->image}");
                if($exist){
                    Storage::disk('public')->delete("images/products/{$product->image}");
                }
            }

            $imageName = Str::random() . '.' . $request->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images/products/', $request->image ,$imageName );
            $product->image = $imageName ;
        }
        else {
            $imageName  = $product->image;
        }

        $product->update($request->post() + ['image' => $imageName ]);



        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        $product = Product::find($id);

        if(! $product){
            return redirect()->route('products.index', $id)->with(['error' => 'This item does not exist']);
        }

        try {
            $product->update([
                'is_approved' => '1',
            ]);
            return redirect()->route('products.index', $id)->with(['success' => 'Successfully Activated']);
       }catch (\Exception $ex) {
            return redirect()->route('products.index', $id)->with(['error' => 'There is an error, please try again later']);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function deactive($id)
    {
        $product = Product::find($id);

        if(! $product){
            return redirect()->route('products.index', $id)->with(['error' => 'This item does not exist']);
        }

        try {
            $product->update([
                'is_approved' => '0',
            ]);
            return redirect()->route('products.index', $id)->with(['success' => 'Successfully Deactivated']);
       }catch (\Exception $ex) {
            return redirect()->route('products.index', $id)->with(['error' => 'There is an error, please try again later']);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            $exist = Storage::disk('public')->exists("images/products/{$product->image}");
            if ($exist) {
                Storage::disk('public')->delete("images/products/{$product->image}");
            }
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted  Successfully');
    }

    public function softDelete($id)
    {
        $product = Product::find($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted  Successfully');
    }

    public function hardDelete($id)
    {
        // if ($product->image) {
        //     $exist = Storage::disk('public')->exists("images/products/{$product->image}");
        //     if ($exist) {
        //         Storage::disk('public')->delete("images/products/{$product->image}");
        //     }
        // }

        $product = Product::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('products.trash')->with('success', 'Product Deleted  Successfully');
    }

    public function recover($id)
    {
        $product = Product::onlyTrashed()->where('id', $id)->first()->restore() ;
        return redirect()->route('products.index')->with('success', 'Product Deleted  Successfully');
    }

}
