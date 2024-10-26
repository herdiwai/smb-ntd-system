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
        Schema::table('mrrequest', function (Blueprint $table) {
            $table->string('status_mrr')->default('incomplete'); // First Status incomplete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mrrequest', function (Blueprint $table) {
            $table->dropColumn('mrrequest');
        });
    }
};
