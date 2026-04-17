<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rute bawaan Breeze untuk Edit Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Pastikan diarahkan ke fungsi 'about' di Controller 
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    
    Route::get('/product/export', function () {
        return 'Selamat! Anda berhasil masuk ke halaman Export khusus Admin.';
    })->middleware('can:export-product')->name('product.export');
});

require __DIR__.'/auth.php';