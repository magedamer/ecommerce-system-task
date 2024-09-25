<?php

use App\Models\ShopProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ShopProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () { 
    Route::get('/latest-shop-products', [ShopProductController::class, 'latestShopProducts']);
    Route::get('/category-shop-products', [ShopProductController::class, 'categoryShopProducts']);
    Route::post('/orders', [OrderController::class, 'addOrder'])->name('add.order');

    Route::post('logout', [UserController::class, 'logout']);
});


