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
        Schema::create('additional_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_approval_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel review
            $table->text('comment')->nullable(); // Komentar tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_comments');
    }
};
