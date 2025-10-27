<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolarDetail extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'customer_id',
        'solar_type',
        'inverter_capacity',
        'inverter_serial_number',
        'number_of_panels',
        'panel_type',
        'panel_voltage',
        'jan_samarth_registration_date',
        'roof_type',
        'roof_area',
        'capacity',
        'solar_company',
        'inverter_company',
        'jan_samarth_id',
        'payment_mode',
        'light_bill_no',
        'application_ref_no',
        'channel_partner_id',
        'registration_date',
        'solar_total_amount',
        'installers',
        'installation_date',
        'total_received_amount',
        'date_full_payment',
        'wiring_department_name',
        'structure_department_name',
        'sr_number',
        'meter_payment_receipt_number',
        'meter_payment_date',
        'meter_payment_amount',
        'panel_serial_numbers',
        'dcr_certificate_number',
        'is_completed',
        'created_at',
        'updated_at',
        'deleted_at',
        // New added fields in DB
        'coapplicant_loan_type',
        'coapplicant_jan_samarth_id',
        'coapplicant_jan_samarth_registration_date',
        'coapplicant_bank_name_loan',
        'coapplicant_bank_branch_loan',
        'coapplicant_account_number_loan',
        'coapplicant_ifsc_code_loan',
        'coapplicant_branch_manager_phone_loan',
        'coapplicant_loan_manager_phone_loan',
        'coapplicant_loan_status',
        'coapplicant_loan_sanction_date',
        'coapplicant_loan_disbursed_date',
        'coapplicant_managed_by',
        'installation_status',
        'subsidy_status',
        'loan_status',
        'inserted_by',
        'discom_name',
        'discom_division',
        'loan_approved_percent',
        'loan_amount',
        'margin_money',
        'margin_money_status',
        'payment_receive_date',
    ];
}
