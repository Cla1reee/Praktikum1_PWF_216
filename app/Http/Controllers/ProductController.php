<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua data produk milik user yang sedang login
        $products = Product::where('user_id', auth()->id())->get();
        
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        
        // Suntikkan ID user yang sedang login secara otomatis
        $validated['user_id'] = auth()->id();
        
        Product::create($validated);
        
        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        return view('product.edit', compact('product'));
    }      

    public function update(UpdateProductRequest $request, Product $product)
    {
        Gate::authorize('update', $product);

        $validated = $request->validated();

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Data produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);

        $product->delete();
        
        return redirect()->route('product.index')->with('success', 'Data produk berhasil dihapus secara permanen!');
    }
}