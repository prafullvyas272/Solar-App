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
            $table->string('discom_name')->nullable()->after('installation_date');
            $table->string('discom_division')->nullable()->after('discom_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solar_details', function (Blueprint $table) {
            $table->dropColumn('discom_division');
            $table->dropColumn('discom_name');
        });
    }
};
