<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('speaking_materials') && !Schema::hasTable('learning_materials')) {
            Schema::rename('speaking_materials', 'learning_materials');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('learning_materials') && !Schema::hasTable('speaking_materials')) {
            Schema::rename('learning_materials', 'speaking_materials');
        }
    }
};
