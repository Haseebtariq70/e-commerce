<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\admincontroller;


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

Route::get('/',[Homecontroller::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect',[Homecontroller::class,'redirect']);
Route::get('/shop_now',[Homecontroller::class,'shop_now']);
Route::get('/all_product',[Homecontroller::class,'all_product']);
Route::get('/contact',[Homecontroller::class,'contact']);
Route::post('/send_message',[Homecontroller::class,'send_message']);
Route::get('/product_detail/{id}',[Homecontroller::class,'product_detail']);
Route::post('/add_cart/{id}',[Homecontroller::class,'add_cart']);
Route::get('/show_cart',[Homecontroller::class,'show_cart']);
Route::post('/cart_update/{id}',[Homecontroller::class,'cart_update']);

Route::get('/remove_cart/{id}',[Homecontroller::class,'remove_cart']);
Route::get('/cash_order',[Homecontroller::class,'cash_order']);
Route::get('/stripe/{totalprice}',[Homecontroller::class,'stripe']);
Route::post('stripe/{totalprice}',[Homecontroller::class,'stripePost'])->name('stripe.post');
Route::get('/show_order',[Homecontroller::class,'show_order']);
Route::get('/cancel_order/{id}',[Homecontroller::class,'cancel_order']);



               //Admin controller

Route::get('/view_catagory',[admincontroller::class,'view_catagory']);
Route::post('/add_catagory',[admincontroller::class,'add_catagory']);
Route::get('/delete_catagory/{id}',[admincontroller::class,'delete_catagory']);

Route::get('/view_product',[admincontroller::class,'view_product']);
Route::post('/add_product',[admincontroller::class,'add_product']);
Route::get('/show_product',[admincontroller::class,'show_product']);
Route::get('/delete_product/{id}',[admincontroller::class,'delete_product']);
Route::get('/update_product/{id}',[admincontroller::class,'update_product']);
Route::post('/all_product_update/{id}',[admincontroller::class,'all_product_update']);

Route::get('/order',[admincontroller::class,'order']);
Route::get('/delivered/{id}',[admincontroller::class,'delivered']);

Route::get('message',[admincontroller::class,'message']);
Route::get('/search',[admincontroller::class,'searchdata']);




