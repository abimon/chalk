<?php

namespace App\Http\Controllers;

use App\Models\likes;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(request()->post_id);
        $id = request()->post_id;
        $like = likes::where('post_id', $id)->where('user_id', Auth()->user()->id)->first();
        if (!$like) {
            likes::create([
                'user_id' => Auth()->user()->id,
                'post_id' => $id
            ]);
        } else {
            likes::destroy($like->id);
        }
        return redirect()->back();
    }

    public function store(Request $request)
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
