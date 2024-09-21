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
        Schema::table('process_model', function (Blueprint $table) {
            $table->dropForeign(['p_d_hourly_output_id']);
            $table->dropColumn('p_d_hourly_output_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('process_model', function (Blueprint $table) {
            $table->foreignIdFor(PDHourlyOutput::class)->constrained()->onDelete('cascade');
        });
    }
};
