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
        Schema::create('loans', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('id_client');
            $table->decimal('loan_Amount', 12, 2);
            $table->decimal('interest_Rate', 5, 2);
            $table->integer('loan_Term')->nullable();
            $table->decimal('payment_Amount', 12, 2)->nullable();
            $table->date('start_Date')->nullable();
            $table->date('end_Date')->nullable();
            $table->string('picture', 255)->nullable();
            $table->string('video', 255)->nullable();
            $table->integer('status')->default(0)->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
