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
        Schema::table('mrrequest', function (Blueprint $table) {
            $table->foreignId('user_id_updated_result')->nullable()->constrained(); // Relasi to table users (fo updated mmr result)
            $table->foreignId('user_id_updated_spv')->nullable()->constrained(); // Relasi to table users (fo updated mmr spv)
            $table->foreignId('user_id_updated_qc')->nullable()->constrained(); // Relasi to table users (fo updated mmr spv)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mrrequest', function (Blueprint $table) {
            $table->dropColumn(['user_id_updated_result', 'user_id_updated_spv','user_id_updated_qc']);
        });
    }
};
