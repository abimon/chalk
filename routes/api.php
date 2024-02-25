<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/v1/callback/{serial}',[OrderController::class,'Callback']);
Route::post('/services/callback/{codec}',[ProductsController::class,'Callback']);