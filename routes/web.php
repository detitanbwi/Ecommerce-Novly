<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Product;

use App\Http\Controllers\ProductController;

// Frontend
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/product/{product}', function(Product $product) {
    return view('catalog.show', compact('product'));
})->name('product.show');

// Admin Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\Admin\StokController;
use App\Http\Controllers\Admin\SettingController;

// Admin Panel (Protected)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/stok', [StokController::class, 'index'])->name('admin.stok');
    Route::get('/stok/create', [StokController::class, 'create'])->name('admin.stok.create');
    Route::post('/stok', [StokController::class, 'store'])->name('admin.stok.store');
    Route::get('/stok/{product}/edit', [StokController::class, 'edit'])->name('admin.stok.edit');
    Route::put('/stok/{product}', [StokController::class, 'update'])->name('admin.stok.update');
    Route::delete('/stok/{product}', [StokController::class, 'destroy'])->name('admin.stok.destroy');
    
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
});
