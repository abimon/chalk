<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\viewer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{

    public function index()
    {
        if (Auth()->user()->role == 'Admin') {
            $articles = article::all();
        } else {
            $articles = article::where('author', Auth()->user()->id)->get();
        }
        return view('articles.index', compact('articles'))->with('users');
    }

    public function create()
    {
        return view('articles.create');
    }


    public function store(Request $request)
    {
        article::create([
            'title' => request()->title,
            'category' => request()->category,
            'body' => request()->body,
            'slug' => Str::slug(request()->title, '_'),
            'author' => Auth()->user()->id
        ]);
        return redirect('/article/index');
    }

    public function show($id)
    {
        $item = article::findOrFail($id);
        return view('articles.show', compact('items'));
    }

    public function edit($id)
    {
        $item = article::findOrFail($id);
        return view('articles.edit', compact('item'));
    }


    public function update(Request $request, $id)
    {
        article::where('id', $id)->update([
            'title' => request()->title,
            'category' => request()->category,
            'body' => request()->body,
            'slug' => Str::slug(request()->title, '_')
        ]);
        return redirect('/dashboard');
    }

    public function destroy($id)
    {
        //
    }
}
