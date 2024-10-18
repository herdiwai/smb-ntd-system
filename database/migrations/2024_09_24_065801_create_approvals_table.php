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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_testing_reports')->constrained()->onDelete('no action'); // Merujuk ke form yangdisetuui
            $table->foreignId('manager_id')->constrained('users')->onDelete('no action'); //Manager yang menyetujui/ menolak
            $table->enum('approvals_status', ['pending', 'approved', 'rejected'])->default('pending'); // Status persetujuan
            $table->text('notes')->nullable(); // Alasan penolakan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
