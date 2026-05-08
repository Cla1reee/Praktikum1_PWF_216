<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductApiController extends Controller
{
    // GET: Menampilkan semua produk
    public function index()
    {
        try {
            $products = Product::with('category')->get();
            return response()->json([
                'message' => 'Berhasil mengambil daftar produk',
                'data' => $products
            ], 200);
        } catch (\Throwable $e) {
            Log::error('API Product Index Error: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    // POST: Menyimpan produk baru (Yang Tadi Anda Hilangkan!)
    public function store(Request $request)
    {
        try {
            // Validasi langsung tanpa butuh file StoreProductRequest terpisah
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'qty' => 'required|integer',
                'category_id' => 'nullable|exists:categories,id'
            ]);

            $validated['user_id'] = Auth::id(); // Ambil ID dari Bearer Token

            $product = Product::create($validated);

            Log::info('API: Menambah data produk', ['list' => $product]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah product: ' . $e->getMessage());
            return response()->json(['message' => 'Input tidak valid atau terjadi kesalahan'], 500);
        }
    }

    // GET: Menampilkan satu produk berdasarkan ID (Yang Tadi Anda Hilangkan!)
    public function show($id)
    {
        try {
            $product = Product::with('category')->find($id);

            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    // PUT: Memperbarui produk
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Produk tidak ditemukan'], 404);
            }

            // Keamanan mutlak: Hanya pemilik produk yang boleh edit
            if ($product->user_id !== Auth::id()) {
                return response()->json(['message' => 'Akses ditolak'], 403);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'qty' => 'required|integer',
                'category_id' => 'nullable|exists:categories,id'
            ]);

            $product->update($validated);

            Log::info('API: Produk diperbarui', ['product' => $product]);

            return response()->json([
                'message' => 'Produk berhasil diperbarui',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('API Product Update Error: ' . $e->getMessage());
            return response()->json(['message' => 'Input tidak valid atau terjadi kesalahan'], 500);
        }
    }

    // DELETE: Menghapus produk
    public function destroy($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Produk tidak ditemukan'], 404);
            }

            // Keamanan mutlak: Hanya pemilik produk yang boleh hapus
            if ($product->user_id !== Auth::id()) {
                return response()->json(['message' => 'Akses ditolak'], 403);
            }

            $product->delete();

            Log::info('API: Produk dihapus', ['id' => $id]);

            return response()->json([
                'message' => 'Produk berhasil dihapus'
            ], 204);
        } catch (\Throwable $e) {
            Log::error('API Product Destroy Error: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }
}