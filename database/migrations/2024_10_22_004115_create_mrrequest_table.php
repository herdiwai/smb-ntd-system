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
        Schema::create('mrrequest', function (Blueprint $table) {
            $table->id();
            $table->string('Request_dept')->nullable();
            $table->string('Name')->nullable();
            $table->foreignId('Equipment_id')->constrained()->onDelete('cascade'); // Relasi to table equipment_no
            $table->string('Description')->nullable();
            $table->foreignId('model_id')->constrained()->onDelete('cascade'); // Relasi to table models
            $table->foreignId('processes_id')->constrained()->onDelete('cascade'); // Relasi to table processs
            $table->foreignId('shift_id')->constrained()->onDelete('cascade'); // Relasi to table shifts
            $table->foreignId('lot_id')->constrained()->onDelete('cascade'); // Relasi to table lots
            $table->foreignId('line_id')->constrained()->onDelete('cascade'); // Relasi to table Line
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi to table users
            $table->string('Date_pd')->nullable();
            $table->string('Breakdown_time')->nullable();
            $table->string('Report_time')->nullable();
            $table->foreignId('Status_approvals_id_spv_pd')->nullable()->constrained();
            $table->string('Note_spv_pd')->nullable();
            $table->string('Judgement')->nullable();
            $table->string('Issue')->nullable();
            $table->string('Root_cause')->nullable();
            $table->string('Action')->nullable();
            $table->string('Repair_by')->nullable();
            $table->string('Response_time')->nullable();
            $table->string('Repair_start_time')->nullable();
            $table->string('Repair_end_time')->nullable();
            $table->string('Qc_start_time')->nullable();
            $table->string('Qc_end_time')->nullable();
            $table->foreignId('Status_approvals_id_qc')->nullable()->constrained();
            $table->string('Note_qc')->nullable();
            $table->string('Date_qc')->nullable();
            $table->foreignId('Status_approvals_id_spv_ntd')->nullable()->constrained();
            $table->string('Note_spv_ntd')->nullable();
            $table->string('Date_spv_ntd')->nullable();
            $table->foreignId('Status_approvals_id_spv_mt')->nullable()->constrained();
            $table->string('Note_spv_mt')->nullable();
            $table->string('Date_spv_mt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mrrequest');
    }
};
