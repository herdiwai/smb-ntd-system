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
        Schema::create('subassy_inspection_check_result', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('model')->nullable();
            $table->string('product_name')->nullable();
            $table->string('production_unit')->nullable();
            $table->string('frequency_of_inspection')->nullable();
            $table->string('inspection_standard')->nullable();
            $table->string('line')->nullable();
            $table->string('shift')->nullable();
            $table->string('lot')->nullable();
            $table->string('inspected_by')->nullable();
            $table->string('reviewed_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subassy_inspection_check_result');
    }
};
