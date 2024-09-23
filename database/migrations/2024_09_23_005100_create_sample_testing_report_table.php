<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sample_testing_report', function (Blueprint $table) {
            $table->id();
            $table->string('summary_after')->nullable();
            $table->string('schedule_of_test')->nullable();
            $table->string('est_of_completion_date')->nullable();
            $table->string('report_no')->nullable();
            $table->string('result_test')->nullable();
            $table->string('remark_test')->nullable();
            $table->string('inspector')->nullable();
            $table->string('date')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi to table users           
            $table->foreignId('sample_testing_requisition_id')->constrained()->onDelete('no action');// Relasi to table sample testing requisition           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_testing_report');
    }
};
