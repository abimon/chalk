<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StudentController;
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
Route::get('/test', [viewsController::class, 'testLog']);
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/lifestyle', function () {
    return view('services');
});
Route::get('/articles', [ArticlesController::class, 'home']);
Route::get('/logout', function () {
    Auth()->logout();
    return redirect('/');
});

Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/{category}', [ProductsController::class, 'show']);
Route::post('/search', [ProductsController::class, 'search']);

Route::get('/log', [viewsController::class, 'testLog']);
Auth::routes();

//patient routes
Route::get('/patientreg', [PatientController::class, 'index']);
Route::post('/patient/create', [PatientController::class, 'create']);

//student routes
Route::get('/studentreg', [StudentController::class, 'index']);
Route::post('/student/create', [StudentController::class, 'create']);

//Articles
Route::get('/article/index', [ArticlesController::class, 'index']);
Route::post('/article/create', [ArticlesController::class, 'create']);
Route::get('/article/destroy/{id}', [ArticlesController::class, 'destroy']);
Route::post('/article/edit/{id}', [ArticlesController::class, 'edit']);
Route::get('/article/view/{title}', [ArticlesController::class, 'show']);
Route::get('/article/like/{title}', [ArticlesController::class, 'like']);
Route::post('/article/comment/{title}', [ArticlesController::class, 'comment']);


Route::middleware('auth')->group(function () {
    //Product routes
    Route::post('/product/addProduct', [ProductsController::class, 'create']);
    Route::get('/product/deleteProduct/{id}', [ProductsController::class, 'destroy']);
    Route::get('/stock', [ProductsController::class, 'store']);

    //Cart Routes
    Route::get('/cart', [CartController::class, 'viewCart']);
    Route::get('/cart/addtocart/{id}', [CartController::class, 'addtocart']);
    Route::get('/cart/destroyCart/{id}', [CartController::class, 'destroyCart']);
    Route::get('/cart/increaseCart/{id}', [CartController::class, 'increaseCart']);
    Route::get('/cart/decreaseCart/{id}', [CartController::class, 'decreaseCart']);

    //Orders Routes
    Route::post('/order/makeOrder', [OrderController::class, 'makeOrder']);
    Route::post('/order/payOrder', [OrderController::class, 'payOrder']);
    Route::get('/order/updateOrder/{id}', [OrderController::class, 'updateOrder']);
    Route::get('/order/view', [OrderController::class, 'viewOrder']);
    Route::get('/orders', [OrderController::class, 'orders']);

    //Articles Routes

    Route::get('/article/index', [ArticlesController::class, 'index']);
    Route::post('/article/create', [ArticlesController::class, 'create']);
    Route::get('/article/destroy/{id}', [ArticlesController::class, 'destroy']);
    Route::post('/article/edit/{id}', [ArticlesController::class, 'edit']);
    Route::get('/article/view/{title}', [ArticlesController::class, 'show']);
    Route::get('/article/like/{title}', [ArticlesController::class, 'like']);
    Route::post('/article/comment/{title}', [ArticlesController::class, 'comment']);

    //Customers Routes
    Route::get('/customer/makeAdmin/{id}', [CustomerController::class, 'makeCustomer']);
    Route::get('/customer/destroyCustomer/{id}', [CustomerController::class, 'destroyCustomer']);
    Route::get('/customer/view', [CustomerController::class, 'viewCustomers']);

    Route::post('/updateProfile', [CustomerController::class, 'updateProfile']);
    Route::get('/profile', function () {
        return view('auth.profile');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});
