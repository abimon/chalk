<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    function viewCart(){
        $cart = DB::table('carts')->where('buyer_id',(Auth()->user()->id))->join('products','carts.product_id','=','products.id')->select('carts.*','products.product_name','products.path','products.price')->get();
        $total=0;
        foreach($cart as $item){
            $total+=($item->price)*($item->quantity);
        }
        $data=[
            'carts'=>$cart,
            'total'=>$total
        ];
        return view('cart',$data);
    }
    function addtocart($id)
    {
        $cart = Cart::where([['product_id',$id],['buyer_id',Auth()->user()->id]])->first();
        if(!$cart){
            cart::create([
                'product_id' => $id,
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
    function destroyCart($id)
    {
        cart::destroy($id);
        return redirect()->back();
    }
    function increaseCart($id)
    {
        $cart = cart::where('id', $id)->first();
        $cart->quantity += 1;
        $cart->update();
        return redirect()->back();
    }
    function decreaseCart($id)
    {
        $cart = cart::where('id', $id)->first();
        $cart->quantity -= 1;
        $cart->update();
        return redirect()->back();
    }
}
