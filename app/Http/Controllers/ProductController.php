<?php

namespace App\Http\Controllers;

use App\Models\message;
use App\Models\product;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store()
    {
        $file='';
        if (request()->hasFile('file')) {
            $extension = request()->file('file')->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            request()->file('file')->storeAs('public/images/products', $filename);
        } else {
            return redirect()->back()->withInput()->with('error', 'No product image found. Please add one.');
        }
        if (request()->cat == 'Ebook') {
            if (request()->hasFile('ebook')) {
                $extension = request()->file('ebook')->getClientOriginalExtension();
                $file = time() . '.' . $extension;
                $path=request()->file('ebook')->storeAs('public/products/Ebooks', $file);
                $category = 'Ebook';
            } else {
                return redirect()->back()->withInput()->with('error', 'For Ebooks,, file can not be null.');
            }
        } else {
            $category = request()->category;
        }
        product::create([
            'product_name' => request()->name,
            'path' => $filename,
            'file_path' => $path,
            'price' => request()->price,
            'details' => request()->desc,
            'category' => $category,
        ]);
        return redirect()->back();
    }

    public function show()
    {
        $keyword = request()->search;
        $products = product::where('product_name', 'LIKE', '%' . $keyword . '%')->get();
        return view('products.show', compact('products'));
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        $product = product::findOrFail($id);
        if (request()->hasFile('file')) {
            $extension = request()->file('file')->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            request()->file('file')->storeAs('public/images/products', $filename);
            $product->path = $filename;
        }
        $product->product_name->request()->name;
        $product->price = request()->price;
        $product->details = request()->desc;
        $product->category = request()->category;
        $product->update();

        return redirect()->back();
    }

    public function destroy($id)
    {
        product::destroy($id);
        return redirect()->back();
    }
    function returnPdf(){
         
        return redirect('/dashboard')->with('message','Successifuly sent document');
    }
}
