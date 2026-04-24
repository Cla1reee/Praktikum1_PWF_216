<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. Menampilkan daftar kategori
    public function index()
    {
        // Hanya ambil kategori milik user yang sedang login
        $categories = Category::withCount('todos')->where('user_id', auth()->id())->get();
        return view('category.index', compact('categories'));
    }

    // 2. Menampilkan form tambah kategori
    public function create()
    {
        return view('category.create');
    }

    // 3. Memproses penyimpanan data
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Category::create([
            'title' => $request->title,
            'user_id' => auth()->id(), // Suntikkan ID user secara otomatis
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit
    public function edit(Category $category)
    {
        // KEAMANAN MUTLAK: Cegah user mengedit kategori orang lain
        abort_if($category->user_id !== auth()->id(), 403, 'THIS ACTION IS UNAUTHORIZED.');

        return view('category.edit', compact('category'));
    }

    // 5. Memproses perubahan data
    public function update(Request $request, Category $category)
    {
        abort_if($category->user_id !== auth()->id(), 403, 'THIS ACTION IS UNAUTHORIZED.');

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $category->update([
            'title' => $request->title,
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // 6. Menghapus data
    public function destroy(Category $category)
    {
        abort_if($category->user_id !== auth()->id(), 403, 'THIS ACTION IS UNAUTHORIZED.');

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus!');
    }
}