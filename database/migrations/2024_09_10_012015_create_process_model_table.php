<?php

use App\Models\PDHourlyOutput;
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
        Schema::create('process_model', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PDHourlyOutput::class)->constrained()->onDelete('cascade');
            $table->string('model')->unique();
            $table->string('process')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_model');
    }
};
