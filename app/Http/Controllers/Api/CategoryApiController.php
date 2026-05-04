<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoryApiController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            return response()->json([
                'message' => 'Berhasil mengambil daftar kategori',
                'data' => $categories
            ], 200);
        } catch (\Throwable $e) {
            Log::error('API Category Index Error: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
            ]);

            $category = Category::create([
                'title' => $request->title,
                'user_id' => Auth::id(), // Diambil dari token Sanctum
            ]);

            Log::info('API: Menambah kategori baru', ['category' => $category]);

            return response()->json([
                'message' => 'Kategori berhasil ditambahkan!',
                'data' => $category,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('API Category Store Error: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan atau input tidak valid'], 500);
        }
    }

    public function show($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            return response()->json([
                'message' => 'Berhasil mengambil data kategori',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('API Category Show Error: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            // Otorisasi Mutlak: Cegah manipulasi data milik orang lain
            if ($category->user_id !== Auth::id()) {
                return response()->json(['message' => 'Akses ditolak'], 403);
            }

            $request->validate([
                'title' => 'required|string|max:255',
            ]);

            $category->update([
                'title' => $request->title,
            ]);

            Log::info('API: Kategori diperbarui', ['category' => $category]);

            return response()->json([
                'message' => 'Kategori berhasil diperbarui',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('API Category Update Error: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            if ($category->user_id !== Auth::id()) {
                return response()->json(['message' => 'Akses ditolak'], 403);
            }

            $category->delete();

            Log::info('API: Kategori dihapus', ['id' => $id]);

            return response()->json([
                'message' => 'Kategori berhasil dihapus'
            ], 204); // 204 No Content sesuai standar HTTP
        } catch (\Throwable $e) {
            Log::error('API Category Destroy Error: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }
}