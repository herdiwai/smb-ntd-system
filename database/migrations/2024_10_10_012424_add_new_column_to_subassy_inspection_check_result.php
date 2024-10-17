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
        Schema::table('subassy_inspection_check_result', function (Blueprint $table) {
            $table->string('status')->nullable(); // Menambahkan kolom baru
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subassy_inspection_check_result', function (Blueprint $table) {
            $table->dropColumn('status'); // Menghapus kolom baru jika rollback
            //
        });
    }
};
