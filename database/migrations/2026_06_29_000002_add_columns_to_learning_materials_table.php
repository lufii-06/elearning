<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('learning_materials', function (Blueprint $table) {
            // Tambah kolom audio jika belum ada
            if (!Schema::hasColumn('learning_materials', 'audio')) {
                $table->string('audio')->nullable()->after('video');
            }
            // Tambah kolom learning_guide jika belum ada
            if (!Schema::hasColumn('learning_materials', 'learning_guide')) {
                $table->string('learning_guide')->nullable()->after('pdf');
            }
            // Tambah package_id sebagai nullable (aman untuk data lama)
            if (!Schema::hasColumn('learning_materials', 'package_id')) {
                $table->foreignId('package_id')
                    ->nullable()
                    ->constrained('packages')
                    ->onDelete('set null')
                    ->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('learning_materials', function (Blueprint $table) {
            // Drop foreign key dulu sebelum drop kolom
            if (Schema::hasColumn('learning_materials', 'package_id')) {
                $table->dropForeign(['package_id']);
                $table->dropColumn('package_id');
            }
            if (Schema::hasColumn('learning_materials', 'audio')) {
                $table->dropColumn('audio');
            }
            if (Schema::hasColumn('learning_materials', 'learning_guide')) {
                $table->dropColumn('learning_guide');
            }
        });
    }
};
