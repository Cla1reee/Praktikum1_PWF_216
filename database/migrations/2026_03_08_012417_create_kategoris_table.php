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
    Schema::create('kategoris', function (Blueprint $table) {
        $table->id(); // Primary Key
        // Relasi ke Product (Foreign Key)
        $table->foreignId('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
        $table->string('name');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
