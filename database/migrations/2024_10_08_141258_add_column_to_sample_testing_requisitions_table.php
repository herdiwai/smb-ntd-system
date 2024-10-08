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
        Schema::table('sample_testing_requisitions', function (Blueprint $table) {
            $table->string('notes_spv')->nullable();
            $table->string('notes_manager')->nullable();
            $table->foreignId('status_approvals_id_qe')->nullable()->constrained();
            $table->string('notes_qe')->nullable();
            $table->foreignId('status_approvals_id_qc')->nullable()->constrained();
            $table->string('notes_qc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sample_testing_requisitions', function (Blueprint $table) {
            //
        });
    }
};
