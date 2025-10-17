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
            $table->float('loan_approved_percent')->nullable()->after('loan_status');
            $table->float('loan_amount')->nullable()->after('loan_approved_percent');
            $table->float('margin_money')->nullable()->after('loan_amount');
            $table->string('margin_money_status')->nullable()->after('margin_money');
            $table->date('payment_receive_date')->nullable()->after('margin_money_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solar_details', function (Blueprint $table) {
            $table->dropColumn('loan_approved_percent');
            $table->dropColumn('loan_amount');
            $table->dropColumn('margin_money');
            $table->dropColumn('margin_money_status');
            $table->dropColumn('payment_receive_date');
        });
    }
};
