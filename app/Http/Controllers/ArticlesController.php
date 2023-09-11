<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\comments;
use App\Models\likes;

class ArticlesController extends Controller
{
    
    function createPost()
    {
        article::create([
            'title' => request()->title,
            'category' => request()->category,
            'body' => request()->body
        ]);
        return redirect()->back();
    }
    function updatePost($id)
    {
        article::where('id', $id)->update([
            'title' => request()->title,
            'category' => request()->category,
            'body' => request()->body
        ]);
        return redirect()->back();
    }
    function deletePost($id)
    {
        article::destroy($id);
        likes::where('post_id', $id)->delete();
        comments::where('post_id', $id)->delete();
        return redirect()->back();
    }
}
