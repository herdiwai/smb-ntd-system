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
        Schema::table('booking_meeting_room', function (Blueprint $table) {
            $table->foreignId('user_id_personel')->after('user_id')->nullable()->constrained();// Relasi to table users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_meeting_room', function (Blueprint $table) {
            $table->dropColumn('user_id_personel'); // Menghapus kolom baru jika rollback
        });
    }
};
