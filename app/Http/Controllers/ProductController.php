<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class ProductController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        $products = Product::all();
        return view('products.products' , compact('sections' , 'products'));
    }

    public function add_product(Request $request)
    {
        $request->validate([
            'product_name'=>'required|unique:products|min:5|max:35',
            'section_id'=>'required',
        ]);

        Product::create([
            'product_name'=>$request->product_name,
            'section_id'=>$request->section_id,
            'description'=>$request->description,
        ]);

        return back()->with('success' , 'Product Added Successfully');
    }

    public function update_product(Request $request)
    {
        $id = Section::where('section_name' , $request->section_name)->first()->id;
        $product = Product::findOrFail($request->pro_id);
        

        $product->update([
            'product_name'=>$request->product_name,
            'description'=>$request->description,
            'section_id'=>$id,
        ]);

        return back()->with('success' , 'Product Updated Successfully');
    }

    public function delete_product($id)
    {
        Product::find($id)->delete();
        return back()->with('success' , 'Product Deleted Successfully');
    }
}
