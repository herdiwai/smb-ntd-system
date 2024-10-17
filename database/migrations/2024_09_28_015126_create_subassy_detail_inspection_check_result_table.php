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
        Schema::create('subassy_detail_inspection_check_result', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inspection_check_id'); // Mendefinisikan kolom sebagai unsignedBigInteger   
            $table->string('inspection_item')->nullable();
            $table->string('defect_grade')->nullable();
            $table->string('sample_no_pcs')->nullable();
            $table->string('time')->nullable();
            $table->string('result')->nullable();
            $table->string('remark_ddca')->nullable();
            $table->string('material_name')->nullable();
            $table->string('test_result')->nullable();
            $table->string('decision')->nullable();
            $table->timestamps();

            // Menambahkan foreign key
            $table->foreign('inspection_check_id')->references('id')->on('subassy_inspection_check_result')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subassy_detail_inspection_check_result');
    }
};
