<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // 1. Menampilkan daftar Todo beserta nama kategorinya
    public function index()
    {
        // Menggunakan 'with' untuk memuat relasi category agar database tidak berat (Eager Loading)
        $todos = Todo::with('category')->where('user_id', auth()->id())->get();
        return view('todo.index', compact('todos'));
    }

    // 2. Menampilkan form tambah Todo
    public function create()
    {
        // Ambil daftar kategori milik user untuk ditampilkan di dropdown Select
        $categories = Category::where('user_id', auth()->id())->get();
        return view('todo.create', compact('categories'));
    }

    // 3. Menyimpan Todo baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id', // Validasi kategori
        ]);

        Todo::create([
            'title' => $request->title,
            'category_id' => $request->category_id, // Simpan ID Kategori
            'user_id' => auth()->id(),
            'is_completed' => false, // Default belum selesai
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit Todo
    public function edit(Todo $todo)
    {
        // Keamanan Mutlak: Cegah user mengedit Todo orang lain
        abort_if($todo->user_id !== auth()->id(), 403, 'THIS ACTION IS UNAUTHORIZED.');
        
        $categories = Category::where('user_id', auth()->id())->get();
        return view('todo.edit', compact('todo', 'categories'));
    }

    // 5. Menyimpan perubahan Todo
    public function update(Request $request, Todo $todo)
    {
        abort_if($todo->user_id !== auth()->id(), 403, 'THIS ACTION IS UNAUTHORIZED.');

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $todo->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'is_completed' => $request->has('is_completed'), // Checkbox handling
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo berhasil diperbarui!');
    }

    // 6. Menghapus Todo
    public function destroy(Todo $todo)
    {
        abort_if($todo->user_id !== auth()->id(), 403, 'THIS ACTION IS UNAUTHORIZED.');
        
        $todo->delete();
        
        return redirect()->route('todo.index')->with('success', 'Todo berhasil dihapus!');
    }
}