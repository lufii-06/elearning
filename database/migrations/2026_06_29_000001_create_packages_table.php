<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // slug, contoh: paket-basic
            $table->string('display_name');   // contoh: Paket Basic
            $table->text('description')->nullable();
            $table->integer('price')->default(0); // harga dalam Rupiah
            $table->boolean('is_free')->default(false);
            $table->string('kategori')->nullable(); // contoh: English
            $table->string('thumbnail')->nullable(); // path ke file thumbnail
            $table->integer('sort_order')->default(0); // untuk urutan tampilan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
