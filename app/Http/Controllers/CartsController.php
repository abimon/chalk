<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function index()
    {
        $carts = cart::where('buyer_id',Auth()->user()->id)->get();
        return view('cart.index',compact('carts'))->with('product');
    }

    public function create()
    {
        $cart = Cart::where([['product_id',request()->id],['buyer_id',Auth()->user()->id]])->first();
        if(!$cart){
            cart::create([
                'product_id' => request()->id,
                'buyer_id' => Auth()->user()->id,
                'quantity' => 1
            ]);
        }
        else{
            $cart->quantity+=1;
            $cart->update();
        }
        return redirect()->back();
    }

    public function store()
    {
        
        
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
