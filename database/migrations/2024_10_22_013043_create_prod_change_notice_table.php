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
        Schema::create('prod_change_notice', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('model')->nullable();
            $table->string('change_notice')->nullable();
            $table->string('line')->nullable();
            $table->string('shift')->nullable();
            $table->string('lot')->nullable();
            $table->string('so_no')->nullable();
            $table->string('co_no')->nullable();
            $table->string('week')->nullable();
            $table->string('implement_datecode')->nullable();
            $table->string('con_no')->nullable();
            $table->string('sah_key')->nullable();
            $table->string('con_name')->nullable();
            $table->string('sn_awal')->nullable();
            $table->string('pic')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prod_change_notice');
    }
};
