<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //get data products
        $products =  DB::table('products')
        ->when($request->input('search'), function($query, $search){
            $query->where('name', 'like','%'. $search . '%');
        })
        ->orderBy('created_at','desc')
        ->paginate(10);
        return view('pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('pages.products.create');
    }

    public function store(Request $request)
    {
        // dd($request); //cek
            $request->validate([
            'name' => 'required|min:3|unique:products',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|in:food,drink,snack',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $filename=time().'.'.$request->image->extension();
        $request->image->storeAs('public/products', $filename);
        $data = $request->all();

        $product = new \App\Models\Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category = $request->category;
        $product->image = $filename;
        $product->save();

        return redirect()->route('product.index')->with('success','User successfully created');
    }

    public function edit($id)
    {
        $product=\App\Models\Product::findOrFail($id);
        return view('pages.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $data=$request->all();
        $product=\App\Models\Product::findOrFail($id);
        $product->update($data);
        return redirect()->route('product.index')->with('success','User successfully updated');
    }

    public function destroy($id)
    {
        $product=\App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success','User successfully deleted');
    }

}
