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
        Schema::create('student_excur_vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'excur_vendor_id')->constrained(table: 'excur_vendors', indexName: 'excurvendor_id');
            $table->foreignId(column: 'student_id')->constrained(table: 'students', indexName: 'student_id');
            $table->integer('score_mid');
            $table->integer('score_final');
            $table->text('url_certificate');
            $table->text('note');
            $table->integer('bill');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentexcurvendors');
    }
};
