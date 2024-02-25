<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function index(){
        $users=User::all();
        
        return view('customers', compact('users'));
    }
    function update($role,$id){
        User::where('id',$id)->update([
            'role'=>$role,
            ]);
        return redirect()->back();
    }
    function destroy($id){
        User::destroy($id);
        return redirect()->back();
    }
    function updateProfile(){
        $id=Auth()->user()->id;
        User::where('id',$id)->update([
            'contact'=>request()->contact,
            'email'=>request()->email,
            'residence'=>request()->residence
        ]);
        return redirect()->back();
    }
    
    
}
