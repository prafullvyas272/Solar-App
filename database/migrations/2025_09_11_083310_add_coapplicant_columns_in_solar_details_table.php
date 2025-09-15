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
            $table->string('coapplicant_loan_type')->nullable()->before('created_at');
            $table->string('coapplicant_jan_samarth_id')->nullable()->before('created_at');
            $table->date('coapplicant_jan_samarth_registration_date')->nullable()->before('created_at');
            $table->string('coapplicant_bank_name_loan')->nullable()->before('created_at');
            $table->string('coapplicant_bank_branch_loan')->nullable()->before('created_at');
            $table->string('coapplicant_account_number_loan')->nullable()->before('created_at');
            $table->string('coapplicant_ifsc_code_loan')->nullable()->before('created_at');
            $table->string('coapplicant_branch_manager_phone_loan')->nullable()->before('created_at');
            $table->string('coapplicant_loan_manager_phone_loan')->nullable()->before('created_at');
            $table->string('coapplicant_loan_status')->nullable()->before('created_at');
            $table->date('coapplicant_loan_sanction_date')->nullable()->before('created_at');
            $table->date('coapplicant_loan_disbursed_date')->nullable()->before('created_at');
            $table->string('coapplicant_managed_by')->nullable()->before('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solar_details', function (Blueprint $table) {
            //
        });
    }
};
