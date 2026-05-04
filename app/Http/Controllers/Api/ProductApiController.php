<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Eager loading kategori untuk menghindari N+1 Query Problem
            $products = \App\Models\Product::with('category')->get();
            return response()->json([
                'message' => 'Berhasil mengambil daftar produk',
                'data' => $products
            ], 200);
        } catch (\Throwable $e) {
            Log::error('API Product Index Error: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = \App\Models\Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Produk tidak ditemukan'], 404);
            }

            if ($product->user_id !== Auth::id()) {
                return response()->json(['message' => 'Akses ditolak'], 403);
            }

            // Ganti validasi ini sesuai dengan kolom yang ada di tabel Product Anda
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

    public function destroy($id)
    {
        try {
            $product = \App\Models\Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Produk tidak ditemukan'], 404);
            }

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
