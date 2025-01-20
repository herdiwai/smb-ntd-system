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
        Schema::create('booking_meeting_room', function (Blueprint $table) {
            $table->id();
            $table->string('Booking_number_id')->nullable();
            $table->string('Name')->nullable();
            $table->string('Department')->nullable();
            $table->string('Description')->nullable();
            $table->string('Start_time')->nullable();
            $table->string('End_time')->nullable();
            $table->string('Date_booking')->nullable();
            $table->string('Status_booking')->nullable();
            $table->foreignId('room_meeting_id')->constrained()->onDelete('cascade'); // Relasi to table room_meeting
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi to table users
            $table->foreignId('user_id_personel')->nullable()->constrained(); // Relasi to table users
            $table->string('Note_personel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_meeting_room');
    }
};
