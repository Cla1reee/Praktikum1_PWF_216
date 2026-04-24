<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // 1. Daftar kolom yang diizinkan untuk diisi secara massal dari form
    protected $fillable = [
        'user_id',       // Pemilik Todo
        'category_id',   // WAJIB ADA! Relasi ke tabel kategori untuk UCP 1
        'title',         // Nama kegiatan
        'is_completed',  // Status selesai/belum
    ];

    // 2. Relasi kembali ke User (Setiap Todo mutlak milik 1 User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 3. Relasi ke Category (Setiap Todo bisa masuk ke 1 Kategori)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}