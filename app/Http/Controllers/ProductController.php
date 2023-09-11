<?php

namespace App\Http\Controllers;

use App\Models\product;

class ProductController extends Controller
{
    function createProduct()
    {
        // dd(request()->category);
        $extension = request()->file('file')->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        request()->file('file')->storeAs('public/images/products', $filename);
        product::create([
            'product_name' => request()->name,
            'path' => $filename,
            'price' => request()->price,
            'details' => request()->desc,
            'category' => request()->category,
        ]);
        return redirect()->back();
    }
    function deleteProduct($id)
    {
        product::destroy($id);
        return redirect()->back();
    }
    function stock()
    {
        $products = product::all();
        $data = [
            'items' => $products,
        ];
        return view('stock', $data);
    }
    function products()
    {
        $products = product::where('category','!=','Literature')->get();
        $data = [
            'products' => $products,
        ];
        return view('products', $data);
    }
    function prodByCategory($category)
    {
        $products = product::where('category',$category)->get();
        $data = [
            'products' => $products,
        ];
        return view('products', $data);
    }
    function search(){
        $keyword=request()->search;
        $products = product::where('product_name','LIKE','%'.$keyword.'%')->get();
        $data = [
            'products' => $products,
        ];
        return view('products', $data);
    }
}
