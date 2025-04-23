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
        Schema::create('return_loan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_loan');
            $table->integer('day_left');
            $table->decimal('money_left_Riel', 15, 2)->nullable();
            $table->decimal('money_left_Baht', 15, 2)->nullable();
            $table->decimal('money_left_Dollar', 15, 2)->nullable();
            $table->decimal('more_money_Riel', 15, 2)->nullable();
            $table->decimal('more_money_Baht', 15, 2)->nullable();
            $table->decimal('more_money_Dollar', 15, 2)->nullable();
            $table->date('start_Date')->nullable();
            $table->enum('status', ['Active', 'Completed', 'Overdue'])->default('Active');
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
        Schema::dropIfExists('return_loan');
    }
};
