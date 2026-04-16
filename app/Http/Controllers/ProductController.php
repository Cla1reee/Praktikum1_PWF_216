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
        $validated = $request->validated();
        
        // Data pasti valid jika lolos ke baris ini, lanjut simpan ke database
        Product::create($validated);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }
}