<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function updateProfile(){
        $id=Auth()->user()->id;
        User::where('id',$id)->update([
            'contact'=>request()->contact,
            'email'=>request()->email,
            'residence'=>request()->residence
        ]);
        return redirect()->back();
    }
    function makeAdmin($id){
        User::where('id',$id)->update([]);
        return redirect('/dashboard');
    }
    function destroyCustomer($id){
        User::destroy($id);
        return redirect()->back();
    }
    function viewCustomers(){
        $users=User::where('role', 'Customer')->get();
        //$users=User::all();
        $data = [
            'customers'=>$users,
        ];
        return view('customers', $data);
    }
}
