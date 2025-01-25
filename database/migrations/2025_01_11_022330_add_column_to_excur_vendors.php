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
        Schema::table('excur_vendors', function (Blueprint $table) {
            $table->date('end_date')->nullable(); // Allows NULL values to avoid issues with existing rows
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('excur_vendors', function (Blueprint $table) {
            $table->dropColumn('end_date'); // Removes the column if the migration is rolled back
        });
    }
};
