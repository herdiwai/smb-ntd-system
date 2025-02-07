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
            $table->string('facilities')->nullable();
            $table->string('remarks_facilities')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_meeting_room', function (Blueprint $table) {
            $table->dropColumn('facilities'); // Menghapus kolom baru jika rollback
            $table->dropColumn('remarks_facilities'); // Menghapus kolom baru jika rollback
        });
    }
};
