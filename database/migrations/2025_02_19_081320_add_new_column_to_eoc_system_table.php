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
            $table->string('DateSubmitContract')->nullable();
            $table->foreignId('user_id_ntd')->after('user_id')->nullable()->constrained();// Relasi to table users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eoc_system', function (Blueprint $table) {
            $table->dropColumn('DateSubmitContract'); // Menghapus kolom baru jika rollback
            $table->dropColumn('user_id_ntd'); // Menghapus kolom baru jika rollback
        });
    }
};
