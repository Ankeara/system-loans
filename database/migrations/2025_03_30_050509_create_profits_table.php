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
        Schema::create('profit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_loan');
            $table->decimal('profit', 12, 2);
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
        Schema::dropIfExists('profits');
    }
};
