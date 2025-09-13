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
        Schema::table('solar_details', function (Blueprint $table) {
            $table->enum('installation_status', ['Pending', 'Installed'])->default('Pending');
            $table->string('subsidy_status')->nullable();
            $table->string('loan_status')->nullable();
            $table->foreignId('inserted_by')->nullable()->constrained('users', 'id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solar_details', function (Blueprint $table) {
            $table->dropForeign(['inserted_by']);
            $table->dropColumn('inserted_by');
            $table->dropColumn('installation_status');
            $table->dropColumn('subsidy_status');
            $table->dropColumn('loan_status');
        });
    }
};
