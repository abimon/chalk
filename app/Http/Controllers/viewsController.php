<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Support\Facades\Log;

class viewsController extends Controller
{
    public function products(){
        $products=product::all();
        return view('products.show',compact('products'));
    }
    public function categorized($category){
        $products = product::where('category',$category)->get();
        return view('products.show', compact('products'));
    }
    public function services(){
        return view('services');
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function profile(){
        return view('profile');
    }
    
}
