<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::all();
        $data = [
            'products' => $products,
        ];
        return view('products.index', $data);
    }

    public function create()
    {
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
    public function store()
    {
        $products = product::all();
        $data = [
            'items' => $products,
        ];
        return view('products.stock', $data);
    }
    public function show($category)
    {
        $products = product::where('category',$category)->get();
        $data = [
            'products' => $products,
        ];
        return view('products.index', $data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    function search(){
        $keyword=request()->search;
        $products = product::where('product_name','LIKE','%'.$keyword.'%')->get();
        $data = [
            'products' => $products,
        ];
        return view('products.index', $data);
    }
    public function destroy($id)
    {
        product::destroy($id);
        return redirect()->back();
    }
}
