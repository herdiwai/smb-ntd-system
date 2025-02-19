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
            $table->foreignId('category_contract_id')->nullable()->constrained();// Relasi to table CategoryContract
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eoc_system', function (Blueprint $table) {
            $table->dropColumn('category_contract_id'); // Menghapus kolom baru jika rollback
        });
    }
};
