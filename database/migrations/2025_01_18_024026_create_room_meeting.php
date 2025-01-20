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
        Schema::create('room_meeting', function (Blueprint $table) {
            $table->id();
            $table->string('Lot')->nullable();
            $table->string('Room_no')->nullable();
            $table->string('Location')->nullable();
            $table->string('Usage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_meeting');
    }
};
