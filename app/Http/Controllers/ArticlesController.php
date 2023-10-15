<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\comments;
use App\Models\likes;

class ArticlesController extends Controller
{
    public function index()
    {
        $l = likes::all();
        $c = comments::all();
        $articles = article::all();
        $data = [
            'items' => $articles,
            'likes' => $l,
            'comments' => $c
        ];
        return view('articles.index', $data);
    }

    public function create()
    {
        article::create([
            'title' => request()->title,
            'category' => request()->category,
            'body' => request()->body
        ]);
        return redirect()->back();
    }
    public function show($title)
    {
        $item = article::where('title', $title)->first();
        $l = likes::where('post_id', $item->id)->get();
        $c = comments::where('post_id', $item->id)->get();
        $data = [
            'item' => $item, 
            'likes' => $l, 
            'comments' => $c
        ];
        return view('articles.show', $data);
    }

    public function edit($id)
    {
        article::where('id', $id)->update([
            'title' => request()->title,
            'category' => request()->category,
            'body' => request()->body
        ]);
        return redirect()->back();
    }
    public function destroy($id)
    {
        article::destroy($id);
        likes::where('post_id', $id)->delete();
        comments::where('post_id', $id)->delete();
        return redirect()->back();
    }
    public function like($id)
    {
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
    public function comment($id)
    {
        comments::create([
            'user_id' => Auth()->user()->id,
            'post_id' => $id,
            'comment' => request()->comment
        ]);
        return redirect()->back();
    }
}
