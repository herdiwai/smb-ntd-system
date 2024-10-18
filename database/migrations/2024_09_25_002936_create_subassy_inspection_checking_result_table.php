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
        Schema::create('subassy_inspection_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('inspection_item');
            $table->string('defect_grade');
            $table->string('sample_no_pcs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subassy_inspection_items');
    }
};
