<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\comments;
use App\Models\viewer;
use App\Models\likes;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class ArticlesController extends Controller
{
    public function index()
    {
        $l = likes::all();
        $c = comments::all();
        if(Auth()->user()->role=='Admin'){
            $articles = article::all();
        }
        else{
            $articles = article::where('author',Auth()->user()->name)->get();
        }
        $data = [
            'items' => $articles,
            'likes' => $l,
            'comments' => $c,
            'views'=>viewer::all()
        ];
        return view('articles.index', $data);
    }

    public function create()
    {
        return view('articles.create');
    }
    public function store(){
        article::create([
            'title' => request()->title,
            'category' => request()->category,
            'body' => request()->body,
            'slug'=>Str::slug(request()->title,'_'),
            'author'=>Auth()->user()->name
        ]);
        return redirect('/article/index');
    }
    public function show($title)
   {
        $item = article::where('slug',$title)->first();
        $new_key= uniqid().'_'.gethostbyaddr($_SERVER["REMOTE_ADDR"]);
        $md_key= md5($new_key);
        if(!isset($_COOKIE['visitor_id'.($item->id)]))
        {
            $view = viewer::where([['user_ip',$md_key],['post_id',$item->id]])->get() ;
            if($view -> count() > 0){
            
            }
            else{
                viewer::create([
                    'user_ip' => $md_key,
                    'post_id' => $item->id,
                 ]);
                setcookie('visitor_id'.($item->id),$md_key,time() + (86400*30), "/");
            }
            
        }
        
        $items = article::all();
        $l = likes::where('post_id',$item->id)->get();
        $c = comments::where('post_id',$item->id)->join('users','users.id','=','comments.user_id')->select('comments.*','users.name')->get();
        $data = [
            'items' => $items,
             'likes' => $l,
            'comments' => $c,
            'item' => $item,
            'views'=>viewer::where('post_id',$item->id)->get()
        ];
        if(!isset($_COOKIE['visitor_id'.($item->id)])) {
            
            if(!$view){
                
                setcookie('visitor_id'.($item->id),$md_key,time() + (86400*30), "/");
            }
        }
        return view('articles.home',$data);
    }

    public function update($id)
    {
        article::where('id', $id)->update([
            'title' => request()->title,
            'category' => request()->category,
            'body' => request()->body,
            'slug'=>Str::slug(request()->title,'_')
        ]);
        return redirect('/dashboard');
    }
    public function edit($id){
        $data=[
            'item'=>article::find($id)
            ];
            return view('articles.edit',$data);
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
    public function validator($request){
        return $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required',
        ]);
    }
    public function home()
    {
        $item = article::latest()->take(1)->first();
        $new_key= uniqid().'_'.gethostbyaddr($_SERVER["REMOTE_ADDR"]);
        $md_key= md5($new_key);
        if(!isset($_COOKIE['visitor_id'.($item->id)]))
        {
            $view = viewer::where([['user_ip',$md_key],['post_id',$item->id]])->get() ;
            if($view -> count() > 0){
            
            }
            else{
                viewer::create([
                    'user_ip' => $md_key,
                    'post_id' => $item->id,
                 ]);
                setcookie('visitor_id'.($item->id),$md_key,time() + (86400*30), "/");
            }
            
        }
        
        $items = article::all();
        $l = likes::where('post_id',$item->id)->get();
        $c = comments::where('post_id',$item->id)->join('users','users.id','=','comments.user_id')->select('comments.*','users.name')->get();
        $data = [
            'items' => $items,
             'likes' => $l,
            'comments' => $c,
            'item' => $item,
            'views'=>viewer::where('post_id',$item->id)->get()
        ];
        if(!isset($_COOKIE['visitor_id'.($item->id)])) {
            
            if(!$view){
                
                setcookie('visitor_id'.($item->id),$md_key,time() + (86400*30), "/");
            }
        }
        return view('articles.home',$data);
    
    }
}
