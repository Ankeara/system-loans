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
        Schema::create('end_loan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_loan');
            $table->enum('status', ['Paid', 'Pending'])->default('Pending');
            $table->timestamps();

            $table->foreign('id_loan')->references('id')->on('loans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('end_loan');
    }
};
