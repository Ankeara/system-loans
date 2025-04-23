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
        Schema::table('loans', function (Blueprint $table) {
            // Add new fields
            $table->decimal('loan_Amount_Riel', 12, 2)->after('id_client');
            $table->decimal('loan_Amount_Baht', 12, 2)->after('loan_Amount_Riel');
            $table->decimal('loan_Amount_Dollar', 12, 2)->after('loan_Amount_Baht');

            // Drop old column
            $table->dropColumn('loan_Amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // Restore old column
            $table->decimal('loan_Amount', 12, 2)->after('id_client');

            // Drop newly added fields
            $table->dropColumn(['loan_Amount_Riel', 'loan_Amount_Baht', 'loan_Amount_Dollar']);
        });
    }
};