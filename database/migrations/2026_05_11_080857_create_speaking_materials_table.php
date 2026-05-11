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
        Schema::create('speaking_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Kolom judul (VARCHAR)
            $table->text('description')->nullable(); // Deskripsi panjang, boleh kosong
            $table->string('video')->nullable(); // Kolom judul (VARCHAR)
            $table->string('pdf')->nullable(); // Kolom judul (VARCHAR)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speaking_materials');
    }
};
