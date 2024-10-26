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
            $table->string('change_from_notice')->nullable(); // Menambahkan kolom baru
            $table->string('change_to_notice')->nullable(); // Menambahkan kolom baru
            $table->string('change_from_datecode')->nullable(); // Menambahkan kolom baru
            $table->string('change_to_datecode')->nullable(); // Menambahkan kolom baru
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prod_change_notice', function (Blueprint $table) {
            $table->dropColumn('change_from_notice'); // Menghapus kolom baru jika rollback
            $table->dropColumn('change_to_notice'); // Menghapus kolom baru jika rollback
            $table->dropColumn('change_from_datecode'); // Menghapus kolom baru jika rollback
            $table->dropColumn('change_to_datecode'); // Menghapus kolom baru jika rollback
        });
    }
};
