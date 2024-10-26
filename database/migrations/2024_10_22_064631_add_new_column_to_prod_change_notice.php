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
        Schema::table('prod_change_notice', function (Blueprint $table) {
            $table->string('sn_rndm')->nullable(); // Menambahkan kolom baru
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prod_change_notice', function (Blueprint $table) {
            $table->dropColumn('sn_rndm'); // Menghapus kolom baru jika rollback
        });
    }
};
