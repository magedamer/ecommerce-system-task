<?php

use App\Http\Controllers\UserController;
use App\Models\ShopProduct;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('home');


Route::post('login', [UserController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth']], function () { 

    Route::get('add/order', function () {
        $shopProducts = ShopProduct::where('user_id', auth()->user()->id)->get();
        return view('add_order_form', compact('shopProducts'));
    });

    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});

