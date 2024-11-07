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
        Schema::create('facility_work_order', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('reported_by')->nullable();
            $table->string('request_by')->nullable();
            $table->string('request_dept')->nullable();
            $table->string('line')->nullable();
            $table->string('lot')->nullable();
            $table->string('shift')->nullable();
            $table->string('location')->nullable();
            $table->string('decription')->nullable();
            $table->string('priority')->nullable();
            $table->string('request_time')->nullable();
            $table->string('assigned_technician')->nullable();
            $table->string('complated_by_technician')->nullable();
            $table->string('time_spent')->nullable();
            $table->string('date_complated_technician')->nullable();
            $table->string('sign_final')->nullable();
            $table->string('name_spv')->nullable();
            $table->string('time_accepted')->nullable();
            $table->string('date_final')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_work_order');
    }
};
