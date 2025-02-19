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
        Schema::create('eoc_system', function (Blueprint $table) {
            $table->id();
            $table->string('EmployeeID')->nullable();
            $table->string('EmployeeName')->nullable();
            $table->string('Position')->nullable();
            $table->string('JoinDate')->nullable();
            $table->string('ContractType')->nullable();
            $table->string('ContractStart')->nullable();
            $table->string('ContractEnd')->nullable();
            $table->string('ContractFinish')->nullable();
            $table->string('CurrentLeaveBalance')->nullable();
            $table->string('Absent')->nullable();
            $table->string('Sick')->nullable();
            $table->string('Performance')->nullable();
            $table->string('Remarks')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eoc_system');
    }
};
