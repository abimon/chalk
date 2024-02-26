<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CommentsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store()
    {
        $id = request()->post_id;
        if(Auth()->user()){
            comments::create([
                'user_id' => Auth()->user()->id,
                'post_id' => $id,
                'comment' => request()->comment
            ]);
        }
        else{
            $data = $this->validator(request());
            $user = User::where('name',$data['name'])->orWhere('email',$data['email'])->orWhere('contact',$data['contact'])->first();
            if(!$user){
                $user=User::create([
                    'name'=>$data['name'],
                    'email'=>$data['email'],
                    'contact'=>$data['contact'],
                    'residence'=>'Unknown',
                    'password'=>Hash::make(time()),
                ]);
            }
            comments::create([
                'user_id' => $user->id,
                'post_id' => $id,
                'comment' => request()->comment
            ]);
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    public function validator($request){
        return $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required',
        ]);
    }
}
