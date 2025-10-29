<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solar Installation Details - {{ $client['customer_number'] ?? 'N/A' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            font-size: 11pt;
        }

        .page {
            page-break-after: always;
            padding: 30px;
        }

        .page:last-child {
            page-break-after: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #4a90e2;
        }

        .header h1 {
            font-size: 24pt;
            color: #4a90e2;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12pt;
            color: #666;
        }

        .section-title {
            font-size: 16pt;
            color: #4a90e2;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e0e0e0;
            font-weight: bold;
        }

        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            font-family: Arial, sans-serif;
            padding: 10px 15px;
            font-weight: 600;
            color: #555;
            width: 40%;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
        }

        .info-value {
            display: table-cell;
            padding: 10px 15px;
            color: #333;
            width: 60%;
            border: 1px solid #e0e0e0;
            border-left: none;
        }

        .two-column {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 0 10px;
        }

        .column:first-child {
            padding-left: 0;
        }

        .column:last-child {
            padding-right: 0;
        }

        .card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 14pt;
            color: #4a90e2;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .highlight-box {
            background-color: #f0f7ff;
            border-left: 4px solid #4a90e2;
            padding: 15px;
            margin-bottom: 20px;
        }

        .highlight-box h3 {
            font-size: 14pt;
            color: #333;
            margin-bottom: 5px;
        }

        .highlight-box p {
            font-size: 11pt;
            color: #666;
        }

        .document-list {
            margin-top: 20px;
        }

        .document-item {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 3px;
            padding: 12px 15px;
            margin-bottom: 10px;
            display: table;
            width: 100%;
        }

        .document-icon {
            display: table-cell;
            width: 30px;
            color: #4a90e2;
            font-size: 14pt;
            vertical-align: middle;
        }

        .document-info {
            display: table-cell;
            vertical-align: middle;
            padding-left: 10px;
        }

        .document-name {
            font-weight: 600;
            color: #333;
            font-size: 11pt;
        }

        .document-date {
            color: #666;
            font-size: 9pt;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            left: 30px;
            right: 30px;
            text-align: center;
            font-size: 9pt;
            color: #999;
            padding-top: 10px;
            border-top: 1px solid #e0e0e0;
        }

        .page-number:after {
            content: counter(page);
        }

        @page {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

    <!-- Page 1: Client Details & Solar Installation Overview -->
    <div class="page">
        <div class="header">
            <h1>Solar Installation Report</h1>
            <p>Customer ID: {{ $client['customer_number'] ?? 'N/A' }}</p>
        </div>

        <div class="highlight-box">
            <h3>{{ trim(($client['first_name'] ?? '') . ' ' . ($client['middle_name'] ?? '') . ' ' . ($client['last_name'] ?? '')) ?: 'N/A' }}</h3>
            <p>Solar Installation Project</p>
        </div>

        <h2 class="section-title">Client Information</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Customer Number</div>
                <div class="info-value">{{ $client['customer_number'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Full Name</div>
                <div class="info-value">{{ trim(($client['first_name'] ?? '') . ' ' . ($client['middle_name'] ?? '') . ' ' . ($client['last_name'] ?? '')) ?: 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email</div>
                <div class="info-value">{{ $client['email'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Mobile</div>
                <div class="info-value">{{ $client['mobile'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Alternate Mobile</div>
                <div class="info-value">{{ $client['alternate_mobile'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">PAN Number</div>
                <div class="info-value">{{ $client['pan_number'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Aadhar Number</div>
                <div class="info-value">{{ $client['aadhar_number'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Age</div>
                <div class="info-value">{{ $client['age'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Gender</div>
                <div class="info-value">{{ $client['gender'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Marital Status</div>
                <div class="info-value">{{ $client['marital_status'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Permanent Address</div>
                <div class="info-value">
                    {{ $client['customer_address'] ?? 'N/A' }}{{ $client['PerAdd_city'] ? ', ' . $client['PerAdd_city'] : '' }}{{ $client['district'] ? ', ' . $client['district'] : '' }}{{ $client['PerAdd_state'] ? ', ' . $client['PerAdd_state'] : '' }}{{ $client['PerAdd_pin_code'] ? ' - ' . $client['PerAdd_pin_code'] : '' }}
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Residential Address</div>
                <div class="info-value">{{ $client['customer_residential_address'] ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <!-- Page 2: Solar System Details -->
    <div class="page">
        <div class="header">
            <h1>Solar System Specifications</h1>
            <p>Customer ID: {{ $client['customer_number'] ?? 'N/A' }}</p>
        </div>

        <h2 class="section-title">Solar System Configuration</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Solar Type</div>
                <div class="info-value">{{ $solar_detail['solar_type'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Roof Type</div>
                <div class="info-value">{{ $solar_detail['roof_type'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Roof Area</div>
                <div class="info-value">{{ $solar_detail['roof_area'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Solar Capacity</div>
                <div class="info-value">{{ $solar_detail['capacity'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Solar Company</div>
                <div class="info-value">{{ $solar_detail['solar_company'] ?? 'N/A' }}</div>
            </div>
        </div>

        <h2 class="section-title">Panel Specifications</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Panel Type</div>
                <div class="info-value">{{ $solar_detail['panel_type'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Number of Panels</div>
                <div class="info-value">{{ $solar_detail['number_of_panels'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Panel Voltage</div>
                <div class="info-value">{{ $solar_detail['panel_voltage'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Panel Serial Numbers</div>
                <div class="info-value">{{ $solar_detail['panel_serial_numbers'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">DCR Certificate Number</div>
                <div class="info-value">{{ $solar_detail['dcr_certificate_number'] ?? 'N/A' }}</div>
            </div>
        </div>

        <h2 class="section-title">Inverter Details</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Inverter Company</div>
                <div class="info-value">{{ $solar_detail['inverter_company'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Inverter Capacity</div>
                <div class="info-value">{{ $solar_detail['inverter_capacity'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Inverter Serial Number</div>
                <div class="info-value">{{ $solar_detail['inverter_serial_number'] ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <!-- Page 3: Financial Details -->
    <div class="page">
        <div class="header">
            <h1>Financial Information</h1>
            <p>Customer ID: {{ $client['customer_number'] ?? 'N/A' }}</p>
        </div>

        <h2 class="section-title">Payment Details</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Payment Mode</div>
                <div class="info-value">{{ $solar_detail['payment_mode'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Solar Total Amount</div>
                <div class="info-value">Rs.  {{ $solar_detail['solar_total_amount'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Total Received Amount</div>
                <div class="info-value">Rs.  {{ $solar_detail['total_received_amount'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Date of Full Payment</div>
                <div class="info-value">{{ $solar_detail['date_full_payment'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Application Reference No.</div>
                <div class="info-value">{{ $solar_detail['application_ref_no'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Light Bill No.</div>
                <div class="info-value">{{ $solar_detail['light_bill_no'] ?? 'N/A' }}</div>
            </div>
        </div>

        <h2 class="section-title">Subsidy Information</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Subsidy Amount</div>
                <div class="info-value">Rs.  {{ $subsidy['subsidy_amount'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Subsidy Status</div>
                <div class="info-value">{{ $subsidy['subsidy_status'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Token ID No.</div>
                <div class="info-value">{{ $subsidy['token_id'] ?? 'N/A' }}</div>
            </div>
        </div>

        <h2 class="section-title">Customer Bank Details</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Bank Name</div>
                <div class="info-value">{{ $customer_bank_detail['bank_name'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Branch</div>
                <div class="info-value">{{ $customer_bank_detail['bank_branch'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Account Number</div>
                <div class="info-value">{{ $customer_bank_detail['account_number'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">IFSC Code</div>
                <div class="info-value">{{ $customer_bank_detail['ifsc_code'] ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <!-- Page 4: Loan Details -->
    <div class="page">
        <div class="header">
            <h1>Loan Information</h1>
            <p>Customer ID: {{ $client['customer_number'] ?? 'N/A' }}</p>
        </div>

        <h2 class="section-title">Loan Applicant Bank Details</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Loan Type</div>
                <div class="info-value">{{ $loan_bank_detail['loan_type'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jan-Samarth ID</div>
                <div class="info-value">{{ $solar_detail['jan_samarth_id'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jan-Samarth Registration Date</div>
                <div class="info-value">{{ $solar_detail['jan_samarth_registration_date'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Bank Name</div>
                <div class="info-value">{{ $loan_bank_detail['bank_name'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Branch</div>
                <div class="info-value">{{ $loan_bank_detail['bank_branch'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Account Number</div>
                <div class="info-value">{{ $loan_bank_detail['account_number'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">IFSC Code</div>
                <div class="info-value">{{ $loan_bank_detail['ifsc_code'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Branch Manager Phone</div>
                <div class="info-value">{{ $loan_bank_detail['branch_manager_phone'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Loan Manager Phone</div>
                <div class="info-value">{{ $loan_bank_detail['loan_manager_phone'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Loan Status</div>
                <div class="info-value">{{ $loan_bank_detail['loan_status'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Loan Sanction Date</div>
                <div class="info-value">{{ $loan_bank_detail['loan_sanction_date'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Loan Disbursal Date</div>
                <div class="info-value">{{ $loan_bank_detail['loan_disbursed_date'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Managed By</div>
                <div class="info-value">{{ $loan_bank_detail['managed_by_name'] ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <!-- Page 5: Installation Details -->
    <div class="page">
        <div class="header">
            <h1>Installation Details</h1>
            <p>Customer ID: {{ $client['customer_number'] ?? 'N/A' }}</p>
        </div>

        <h2 class="section-title">Installation Information</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Installers</div>
                <div class="info-value">{{ $solar_detail['installer_name'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Installation Date</div>
                <div class="info-value">{{ $solar_detail['installation_date'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Registration Date</div>
                <div class="info-value">{{ $solar_detail['registration_date'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Channel Partner</div>
                <div class="info-value">{{ $solar_detail['channel_partner_name'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Structure Department Name</div>
                <div class="info-value">{{ $solar_detail['structure_department_name'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Wiring Department Name</div>
                <div class="info-value">{{ $solar_detail['wiring_department_name'] ?? 'N/A' }}</div>
            </div>
        </div>

        <h2 class="section-title">Meter & Additional Details</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">SR Number</div>
                <div class="info-value">{{ $solar_detail['sr_number'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Meter Payment Receipt No.</div>
                <div class="info-value">{{ $solar_detail['meter_payment_receipt_number'] ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Meter Payment Date</div>
                <div class="info-value">{{ $solar_detail->meter_payment_date ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Meter Payment Amount</div>
                <div class="info-value">Rs.  {{ $solar_detail->meter_payment_amount ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <!-- Page 6: Documents -->
    <div class="page">
        <div class="header">
            <h1>Installation Documents</h1>
            <p>Customer ID: {{ $client['customer_number'] ?? 'N/A' }}</p>
        </div>

        <h2 class="section-title">Document Repository</h2>

        @if(count($appDocument) > 0)
            <div class="document-list">
                @foreach ($appDocument as $file)
                    <div class="document-item">
                        <div class="document-icon">📄</div>
                        <div class="document-info">
                            <div class="document-name">{{ $file['file_display_name'] }}</div>
                            <div class="document-date">Uploaded on: {{ \Carbon\Carbon::parse($file['created_at'])->format('d M Y') }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="highlight-box">
                <p style="text-align: center; color: #666;">No documents available for this installation.</p>
            </div>
        @endif
    </div>

</body>
</html>
