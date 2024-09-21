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
        Schema::create('sample_testing_requisition', function (Blueprint $table) {
            $table->id();
            $table->string('incomming_number')->nullable();
            $table->string('date')->nullable();
            $table->string('do_no')->nullable();
            $table->string('series')->nullable();
            $table->string('co_no')->nullable();
            $table->string('no_of_sample')->nullable();
            $table->string('mfg_sample_date')->nullable();
            $table->string('sample_subtmitted_date')->nullable();
            $table->string('tracebility_datecode')->nullable();
            $table->string('completion_date')->nullable();
            $table->string('test_purpose')->nullable();
            $table->string('pilot_project')->nullable();
            $table->string('check_by')->nullable();
            $table->string('qe_review')->nullable();
            $table->string('reg_accepted')->nullable();
            $table->string('schdule_of_test')->nullable();
            $table->string('est_of_completion_date')->nullable();
            $table->string('report_no')->nullable();
            $table->string('test_result')->nullable();
            $table->foreignId('model_id')->constrained()->onDelete('cascade'); // Relasi to table models
            $table->foreignId('processes_id')->constrained()->onDelete('cascade'); // Relasi to table processs
            $table->foreignId('lot_id')->constrained()->onDelete('cascade'); // Relasi to table lots
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi to table users
            $table->string('status')->default('incomplete'); // First Status incomplete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_testing_requisition');
    }
};
