<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('users', App\Http\Controllers\Api\UserController::class);
Route::apiResource('brands', App\Http\Controllers\Api\BrandController::class);
Route::apiResource('games', App\Http\Controllers\Api\GameController::class);
Route::apiResource('categorys', App\Http\Controllers\Api\CategoriController::class);
Route::apiResource('products', App\Http\Controllers\Api\ProductController::class);
Route::apiResource('vouchers', App\Http\Controllers\Api\VoucherController::class);
Route::apiResource('auth', App\Http\Controllers\Api\AuthController::class);
Route::apiResource('detail', App\Http\Controllers\Api\DetailController::class);

// Route::apiResource('invoices',App\Http\Controllers\Api\InvoiceController::class);

Route::get('invoices', action: [App\Http\Controllers\Api\InvoiceController::class,'index'])->name('invoices.index');
Route::put('invoices/cekTransaksi', [App\Http\Controllers\Api\InvoiceController::class,'cekTransaksi'])->name('invoices.cekTransaksi');

// Route::apiResource('home', App\Http\Controllers\Api\HomeController::class);
Route::get('home', [App\Http\Controllers\Api\HomeController::class,'index'])->name('home.index');
Route::get('home/detail_produk/{id}', [App\Http\Controllers\Api\HomeController::class,'detail_produk'])->name('home.detail_produk');
Route::post('home/transaksi', [App\Http\Controllers\Api\HomeController::class,'transaksi'])->name('home.transaksi');
Route::get('home/detail_transaksi/{id}', [App\Http\Controllers\Api\HomeController::class,'detail_transaksi'])->name('home.detail_transaksi');
Route::put('home/bukti_pembayaran', [App\Http\Controllers\Api\HomeController::class, 'buktiPembayaran'])->name('home.bukti_pembayaran');
Route::post('home/cari_transaksi', [App\Http\Controllers\Api\HomeController::class, 'cariTransaksi'])->name('home.cari_transaksi');
Route::post('home/loginUser', [App\Http\Controllers\Api\AuthController::class, 'loginUser'])->name('home.loginUser');
Route::post('auth/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->name('home.logout');

Route::post('auth/login', [App\Http\Controllers\Api\AuthController::class, 'login'])->name('auth.login');
Route::post('auth/register', [App\Http\Controllers\Api\AuthController::class, 'register'])->name('auth.register');

