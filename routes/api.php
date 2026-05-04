<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;

// Rute Publik (Semua orang bisa baca/lihat)
Route::post('/login', [AuthController::class, 'getToken']);

Route::get('/product', [ProductApiController::class, 'index']);
Route::get('/product/{id}', [ProductApiController::class, 'show']);

Route::get('/category', [CategoryApiController::class, 'index']);
Route::get('/category/{id}', [CategoryApiController::class, 'show']);

// Rute Privat/Terproteksi (Hanya yang punya Bearer Token yang bisa eksekusi)
Route::middleware('auth:sanctum')->group(function () {
    
    // Product Endpoint Mutasi
    Route::post('/product', [ProductApiController::class, 'store']);
    Route::put('/product/{id}', [ProductApiController::class, 'update']);
    Route::delete('/product/{id}', [ProductApiController::class, 'destroy']);
    
    // Category Endpoint Mutasi
    Route::post('/category', [CategoryApiController::class, 'store']);
    Route::put('/category/{id}', [CategoryApiController::class, 'update']);
    Route::delete('/category/{id}', [CategoryApiController::class, 'destroy']);
    
});