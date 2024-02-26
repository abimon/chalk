<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\comments;
use App\Models\likes;
use App\Models\product;
use App\Models\viewer;
use Illuminate\Support\Facades\Log;

class viewsController extends Controller
{
    public function products(){
        $products=product::all();
        return view('products.show',compact('products'));
    }
    public function categorized($category){
        $products = product::where('category',$category)->get();
        return view('products.show', compact('products'));
    }
    public function services(){
        return view('services');
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function profile(){
        return view('profile');
    }
    public function articles()
    {
        $item = article::latest()->take(1)->first();
        $views = viewer::where('post_id',$item->id)->get();
        $comments = comments::where('post_id',$item->id)->get();
        $likes = likes::where('post_id',$item->id)->get();
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
        
        if(!isset($_COOKIE['visitor_id'.($item->id)])) {
            
            if(!$view){
                
                setcookie('visitor_id'.($item->id),$md_key,time() + (86400*30), "/");
            }
        }
        return view('articles.home', compact('items','item','views','likes','comments'));
    
    }
    public function articleShow($slug)
    {
        $item = article::where('slug', $slug)->first();
        $views = viewer::where('post_id',$item->id)->get();
        $comments = comments::where('post_id',$item->id)->get();
        $likes = likes::where('post_id',$item->id)->get();
        // return $views;
        $new_key = uniqid() . '_' . gethostbyaddr($_SERVER["REMOTE_ADDR"]);
        $md_key = md5($new_key);
        if (!isset($_COOKIE['visitor_id' . ($item->id)])) {
            $view = viewer::where([['user_ip', $md_key], ['post_id', $item->id]])->get();
            if ($view->count() > 0) {
            } else {
                viewer::create([
                    'user_ip' => $md_key,
                    'post_id' => $item->id,
                ]);
                setcookie('visitor_id' . ($item->id), $md_key, time() + (86400 * 30), "/");
            }
        }
        $items = article::all();
        if (!isset($_COOKIE['visitor_id' . ($item->id)])) {
            if (!$view) {
                setcookie('visitor_id' . ($item->id), $md_key, time() + (86400 * 30), "/");
            }
        }
        return view('articles.home', compact('items','item','views','likes','comments'));
    }
    
}
