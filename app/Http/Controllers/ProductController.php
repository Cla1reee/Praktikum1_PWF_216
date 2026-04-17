<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // Menampilkan halaman form tambah produk
    public function create()
    {
        return view('product.create');
    }

    // Memproses data dari form tambah produk (Validasi bekerja di sini)
    public function store(StoreProductRequest $request)
    {
        // 1. Ambil data yang sudah lolos validasi
        $validated = $request->validated();
        
        // 2. Suntikkan ID user yang sedang login secara otomatis
        $validated['user_id'] = auth()->id();
        
        // 3. Simpan ke database
        Product::create($validated);
        
        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function index()
    {
        // Mengambil semua data produk milik user yang sedang login
        $products = Product::where('user_id', auth()->id())->get();
        
        // Kirim data ke view product/index.blade.php
        return view('product.index', compact('products'));
    }
}