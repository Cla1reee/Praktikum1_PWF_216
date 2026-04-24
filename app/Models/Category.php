<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 1. Izinkan pengisian data massal untuk kolom ini
    protected $fillable = [
        'user_id',
        'title',
    ];

    // 2. Relasi ke User (Setiap kategori dimiliki oleh 1 user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 3. Relasi ke Todo (Satu kategori bisa menampung banyak todo)
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}