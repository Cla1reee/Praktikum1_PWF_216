<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('products', function (Blueprint $table) {
        $table->id(); // Primary Key
        // Relasi ke User (Foreign Key)
        $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
        $table->string('name');
        $table->integer('qty');
        $table->decimal('price', 15, 2); // Presisi uang: 15 digit total, 2 di belakang koma
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
