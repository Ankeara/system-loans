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
            $table->unsignedBigInteger('id_loan');
            $table->decimal('payment_Amount', 12, 2);
            $table->decimal('not_paid', 12, 2)->default(0.00);
            $table->date('payment_date')->nullable();
            $table->integer('payment_Status')->default(0)->nullable();
            $table->integer('payment_order')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_loan')->references('id')->on('loans')->onDelete('cascade');
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