<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.dashboard');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/auth/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/admin/users', function () {
    return view('admin.user');
});
Route::get('/coba', function () {
    return view('frontend.coba');
});

Route::get('/coba', [HomeController::class, 'generateQris'])->name('coba.qr');

Route::get('/admin/brands', function () {
    return view('admin.brand');
});

Route::get('/admin/categorys', function () {
    return view('admin.categori');
});

Route::get('/admin/products', function () {
    return view('admin.products');
});
Route::get('/admin/invoices', function () {
    return view('admin.invoice');
});

// user routes
Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/admin/users/{id}', [UserController::class, 'delete'])->name('users.delete');

// auth routes
Route::get('/admin/auth/login', [App\Http\Controllers\AuthController::class, 'index'])->name('auth.index');
Route::post('/admin/auth/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');

// brand routes
Route::get('/admin/brands', [App\Http\Controllers\BrandController::class, 'index'])->name('brands.index');
Route::post('/admin/brands', [App\Http\Controllers\BrandController::class, 'store'])->name('brands.store');
Route::put('/admin/brands/{id}', [App\Http\Controllers\BrandController::class, 'update'])->name('brands.update');
Route::get('/admin/brands/{id}', [App\Http\Controllers\BrandController::class, 'destroy'])->name('brands.delete');

// game routes
Route::get('/admin/games', [App\Http\Controllers\GameController::class, 'index'])->name('games.index');
Route::post('/admin/games', [App\Http\Controllers\GameController::class, 'store'])->name('games.store');
Route::put('/admin/games/{id}', [App\Http\Controllers\GameController::class, 'update'])->name('games.update');
Route::get('/admin/games/{id}', [App\Http\Controllers\GameController::class, 'destroy'])->name('games.delete');

// category routes
Route::get('/admin/categorys', [App\Http\Controllers\CategoriController::class, 'index'])->name('categorys.index');
Route::post('/admin/categorys', [App\Http\Controllers\CategoriController::class, 'store'])->name('categorys.store');
Route::put('/admin/categorys/{id}', [App\Http\Controllers\CategoriController::class, 'update'])->name('categorys.update');
Route::get('/admin/categorys/{id}', [App\Http\Controllers\CategoriController::class, 'destroy'])->name('categorys.delete');

// product routes
Route::get('/admin/products', [App\Http\Controllers\ProductsController::class, 'index'])->name('products.index');
Route::post('/admin/products', [App\Http\Controllers\ProductsController::class, 'store'])->name('products.store');
Route::put('/admin/products/{id}', [App\Http\Controllers\ProductsController::class, 'update'])->name('products.update');
Route::get('/admin/products/{id}', [App\Http\Controllers\ProductsController::class, 'destroy'])->name('products.delete');

// voucher routes
Route::get('/admin/vouchers', [App\Http\Controllers\VoucherController::class, 'index'])->name('vouchers.index');
Route::post('/admin/vouchers', [App\Http\Controllers\VoucherController::class, 'store'])->name('vouchers.store');
Route::put('/admin/vouchers/{id}', [App\Http\Controllers\VoucherController::class, 'update'])->name('vouchers.update');
Route::get('/admin/vouchers/{id}', [App\Http\Controllers\VoucherController::class, 'destroy'])->name('vouchers.delete');

// home routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/ketegori/{id}', [App\Http\Controllers\HomeController::class, 'detail_produk'])->name('home.detail_produk');
Route::post('/transaksi', [App\Http\Controllers\HomeController::class, 'transaksi'])->name('home.transaksi');
Route::get('/cari', [App\Http\Controllers\HomeController::class, 'cari'])->name('home.cari');
Route::post('/cek_transaksi', [App\Http\Controllers\HomeController::class, 'cariTransaksi'])->name('home.cariTransaksi');
Route::get('/detail_transaksi/{id}', [App\Http\Controllers\HomeController::class, 'detail_transaksi'])->name('home.detail_transaksi');
Route::put('/', [App\Http\Controllers\HomeController::class, 'buktiPembayaran'])->name('home.bukti_pembayaran');
// Route::get('/login', [App\Http\Controllers\HomeController::class, 'buktiPembayaran'])->name('home.loginUser');

Route::get('/admin/invoices', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.index');
Route::put('/admin/invoices', [App\Http\Controllers\InvoiceController::class, 'cekTransaksi'])->name('invoice.update');


