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
        Schema::table('sample_testing_requisition', function (Blueprint $table) {
            $table->foreignId('approval_manager_id')->constrained()->onDelete('no action')->nullable(); // Relasi to table shifts
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sample_testing_requisition', function (Blueprint $table) {
            $table->dropColumn('sample_testing_requisition');
        });
    }
};
