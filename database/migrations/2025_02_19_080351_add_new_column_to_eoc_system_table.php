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
        Schema::table('eoc_system', function (Blueprint $table) {
            $table->string('CategoryContract')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eoc_system', function (Blueprint $table) {
            $table->dropColumn('CategoryContract'); // Menghapus kolom baru jika rollback
        });
    }
};
