<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\viewsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/test', [viewsController::class,'testLog']);
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/logout', function () {
    Auth()->logout();
    return redirect('/');
});

Route::get('/products', [ProductController::class, 'products']);
Route::get('/products/{category}', [ProductController::class, 'prodByCategory']);
Route::post('/search',[ProductController::class,'search']);
Route::get('/log',[viewsController::class,'testLog']);
Auth::routes();
Route::middleware('auth')->group(function(){
    //Product routes
    Route::post('/product/addProduct',[ProductController::class,'createProduct']);
    Route::get('/product/deleteProduct/{id}',[ProductController::class,'deleteProduct']);
    Route::get('/stock',[ProductController::class,'stock']);

    //Cart Routes
    Route::get('/cart',[CartController::class,'viewCart']);
    Route::get('/cart/addtocart/{id}',[CartController::class,'addtocart']);
    Route::get('/cart/destroyCart/{id}',[CartController::class,'destroyCart']);
    Route::get('/cart/increaseCart/{id}',[CartController::class,'increaseCart']);
    Route::get('/cart/decreaseCart/{id}',[CartController::class,'decreaseCart']);

    //Orders Routes
    Route::post('/order/makeOrder',[OrderController::class,'makeOrder']);
    Route::post('/order/payOrder/{id}',[OrderController::class,'payOrder']);
    Route::get('/order/updateOrder/{id}',[OrderController::class,'updateOrder']);
    Route::get('/order/view',[OrderController::class,'viewOrder']);
    Route::get('/orders',[OrderController::class,'orders']);
    
    //Articles Routes
    Route::post('/articles/createPost',[ArticlesController::class, 'createPost']);
    Route::get('/articles/updatePost/{id}',[ArticlesController::class, 'updatePost']);
    Route::get('/articles/deletePost/{id}',[ArticlesController::class, 'deletePost']);

    //Customers Routes
    Route::get('/customer/makeAdmin/{id}', [CustomerController::class, 'makeCustomer']);
    Route::get('/customer/destroyCustomer/{id}', [CustomerController::class, 'destroyCustomer']);
    Route::get('/customer/view', [CustomerController::class,'viewCustomers']);

    Route::post('/updateProfile', [CustomerController::class, 'updateProfile']);
    Route::get('/profile', function () {return view('profile');});

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    
    
});