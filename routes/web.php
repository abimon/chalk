<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\viewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*****************************
PUBLIC VIEWS NO AUTH REQUIRED
*****************************/
Route::get('/', function () {
    return view('home');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/services', function () {
    return view('services');
});
Route::get('/logout', function () {
    Auth()->logout();
    return redirect('/');
});
Route::controller(viewsController::class)->group(function(){
    Route::get('/products','products');
    Route::get('/products/{category}','categorized');
    Route::get('/services','services');
});

/*********************************
 AUTH ROUTES
 ********************************/
Auth::routes();
Route::middleware('auth')->group(function(){
    Route::controller(viewsController::class)->group(function(){
        Route::get('/dashboard','dashboard');
        Route::get('/profile','profile');
    });
    Route::resources([
        'product'=>ProductController::class,
        'order'=>OrdersController::class,
        'cart'=>CartsController::class,
        'comment'=>CommentsController::class,
        'article'=>ArticlesController::class
    ]);
    Route::get('returnPdf',[ProductController::class,'returnPdf']);
    
});
Route::controller(TransportController::class)->prefix('/transport/')->group(function(){
    Route::post('create','create');
    Route::post('pay','pay');
});