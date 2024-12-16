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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'student_excur_vendor_id')->constrained(table: 'student_excur_vendors', indexName: 'student_excur_vendor_id_m');
            $table->date('payment_date');
            $table->integer('amount');
            $table->text('transfer_url');
            $table->text('status_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
