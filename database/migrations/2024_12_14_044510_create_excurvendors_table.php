<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('excur_vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('extracurricular_id')->constrained(table: 'extracurriculars', indexName: 'extracuricullar_id');
            $table->foreignId('vendor_id')->constrained(table: 'vendors', indexName: 'vendor_id');
            $table->integer('semester');
            $table->year('academic_year');
            $table->date('start_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('pic');
            $table->string('day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excurvendors');
    }
};
