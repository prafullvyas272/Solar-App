<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation - {{ $quotation->quotation_no ?? '100' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.2;
            color: #000;
            margin: 20px;
        }

        .quotation-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            padding: 5px 0;
        }

        .company-info {
            border: 2px solid #000;
            padding: 8px;
            margin-bottom: 0;
        }

        .company-header {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .company-details {
            font-size: 9px;
            line-height: 1.3;
        }

        .quotation-details {
            border: 2px solid #000;
            border-top: none;
            padding: 8px;
            text-align: right;
            margin-bottom: 0;
        }

        .quotation-details table {
            width: 100%;
            margin-left: auto;
            width: 300px;
        }

        .quotation-details td {
            padding: 2px 5px;
            font-size: 10px;
        }

        .billing-shipping {
            display: table;
            width: 100%;
            border: 2px solid #000;
            border-top: none;
            margin-bottom: 0;
        }

        .bill-to, .ship-to {
            display: table-cell;
            width: 50%;
            padding: 8px;
            vertical-align: top;
        }

        .ship-to {
            border-left: 1px solid #000;
        }

        .section-title {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 5px;
        }

        .address {
            font-size: 9px;
            line-height: 1.3;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
            border-top: none;
            margin-bottom: 0;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            font-size: 9px;
        }

        .items-table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .items-table td.text-left {
            text-align: left;
        }

        .items-table td.text-right {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
            background-color: #f5f5f5;
        }

        .tax-breakdown {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
            border-top: none;
            margin-bottom: 0;
        }

        .tax-breakdown th,
        .tax-breakdown td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            font-size: 8px;
        }

        .tax-breakdown th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .total-words {
            border: 2px solid #000;
            border-top: none;
            padding: 5px 8px;
            font-size: 9px;
        }

        .total-words-title {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .currency {
            font-family: 'DejaVu Sans', sans-serif;
        }
    </style>
</head>
<body>
    <div class="quotation-container">
        <!-- Header -->
        <div class="header">
            QUOTATION
        </div>

        <!-- Company Info and Quotation Details -->
        <div style="display: table; width: 100%;">
            <div class="company-info" style="display: table-cell; width: 60%; border-right: none;">
                <div class="company-header">{{ $company->name ?? 'SHIV TRADERS' }}</div>
                <div class="company-details">
                    {{ $company->address ?? 'AT.POST.RAYAPUR TA.BHILODA RAYAPUR DODISARA ROD,' }}<br>
                    {{ $company->city ?? 'Bhiloda' }}, {{ $company->state ?? 'Gujarat' }}, {{ $company->pincode ?? '383355' }}<br><br>
                    <strong>GSTIN:</strong> {{ $company->gstin ?? '24AFKPN4643M1Z2' }} &nbsp;&nbsp;
                    <strong>Mobile:</strong> {{ $company->mobile ?? '9998820863' }}<br>
                    <strong>PAN Number:</strong> {{ $company->pan ?? 'AFKPN4643M' }}<br>
                    <strong>Email:</strong> {{ $company->email ?? 'jbninama7233@Gmail.com' }}
                </div>
            </div>
            <div class="quotation-details" style="display: table-cell; width: 40%; border-left: 1px solid #000;">
                <table>
                    <tr>
                        <td><strong>Quotation No.</strong></td>
                        <td>{{ $quotationData['quotation']->quotation_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Quotation Date</strong></td>
                        <td>{{ \Carbon\Carbon::parse($quotationData['quotation']->created_at)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Expiry Date</strong></td>
                        <td>
                            {{ \Carbon\Carbon::parse($quotationData['quotation']->created_at)->addMonth()->format('d/m/Y') }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Billing and Shipping -->
        <div class="billing-shipping">
            <div class="bill-to">
                <div class="section-title">BILL TO</div>
                <div style="font-weight: bold; margin-bottom: 3px;">{{ $customer->name ?? 'DANIYALBHAI DHULAJI RALEVA' }}</div>
                <div class="address">
                    <strong>Address:</strong> {{ $quotationData['customer']->customer_address ?? 'AT PO-N.DODISARA, TA.BHILODA' }}, District: {{ $quotationData['customer']->district ?? 'Arvalli' }}, State: {{ $quotationData['customer']->PerAdd_state ?? 'GUJARAT' }}, PIN Code: {{ $quotationData['customer']->PerAdd_pin_code ?? '383355' }}
                </div>
            </div>
            <div class="ship-to">
                <div class="section-title">SHIP TO</div>
                <div style="font-weight: bold; margin-bottom: 3px;">{{ $shipping->name ?? 'DANIYALBHAI DHULAJI RALEVA' }}</div>
                <div class="address">
                    <strong>Address:</strong> {{ $quotationData['customer']->customer_address ?? 'AT PO-N.DODISARA, TA.BHILODA' }}, District: {{ $quotationData['customer']->district ?? 'Arvalli' }}, State: {{ $quotationData['customer']->PerAdd_state ?? 'GUJARAT' }}, PIN Code: {{ $quotationData['customer']->PerAdd_pin_code ?? '383355' }}
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 8%;">S.NO.</th>
                    <th style="width: 35%;">ITEMS</th>
                    <th style="width: 10%;">HSN</th>
                    <th style="width: 10%;">QTY.</th>
                    <th style="width: 10%;">RATE</th>
                    <th style="width: 12%;">TAX</th>
                    <th style="width: 15%;">AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items ?? [] as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $item->description }}</td>
                    <td>{{ $item->hsn_code }}</td>
                    <td>{{ $item->quantity }} {{ $item->unit }}</td>
                    <td class="text-right">{{ number_format($item->rate, 0) }}</td>
                    <td class="text-right">
                        {{ number_format($item->tax_amount, 1) }}<br>
                        <small>({{ $item->tax_rate }}%)</small>
                    </td>
                    <td class="text-right">{{ number_format($item->amount, 1) }}</td>
                </tr>
                @endforeach

                <!-- Default items if no data provided -->
                @if(empty($items))
                @php
                    $solarTax = ( $quotationData['solar_detail']->solar_total_amount * $quotationData['solar_detail']->number_of_panels) * 12 / 100
                @endphp
                <tr>
                    <td>1</td>
                    <td class="text-left">sasa black 545 solar module</td>
                    <td>{{ $quotationData['solar_detail']->sr_number }}</td>
                    <td>{{ $quotationData['solar_detail']->capacity }} KW</td>
                    <td class="text-right">{{ $quotationData['solar_detail']->solar_total_amount }}</td>
                    <td class="text-right">
                        {{ $solarTax }}<br>
                        <small>(12%)</small>
                    </td>
                    <td class="text-right">{{ $quotationData['solar_detail']->solar_total_amount * $quotationData['solar_detail']->number_of_panels }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="text-left">visole 3.60 solar invertor</td>
                    <td>{{ $quotationData['solar_detail']->inverter_serial_number }}</td>
                    <td>{{ $quotationData['solar_detail']->inverter_capacity }} KW</td>
                    <td class="text-right">NEED_DYNAMIC_DATA</td>
                    <td class="text-right">
                        NEED_DYNAMIC_DATA<br>
                        <small>(12%)</small>
                    </td>
                    <td class="text-right">NEED_DYNAMIC_DATA</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="text-left">electrical materials and structure materials</td>
                    <td>-</td>
                    <td>1 UNT</td>
                    <td class="text-right">57,576</td>
                    <td class="text-right">
                        10,363.68<br>
                        <small>(18%)</small>
                    </td>
                    <td class="text-right">67,939.68</td>
                </tr>
                @endif

                <tr class="total-row">
                    <td colspan="5" style="text-align: center;"><strong>TOTAL</strong></td>
                    <td class="text-right"><strong><span class="currency">₹</span> {{ number_format($totals->total_tax ?? 23334.48, 2) }}</strong></td>
                    <td class="text-right"><strong><span class="currency">₹</span> {{ number_format($totals->grand_total ?? 189000.48, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Tax Breakdown -->
        <table class="tax-breakdown">
            <thead>
                <tr>
                    <th rowspan="2">HSN/SAC</th>
                    <th rowspan="2">Taxable Value</th>
                    <th colspan="2">CGST</th>
                    <th colspan="2">SGST</th>
                    <th rowspan="2">Total Tax Amount</th>
                </tr>
                <tr>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tax_breakdown ?? [] as $tax)
                <tr>
                    <td>{{ $tax->hsn_code }}</td>
                    <td>{{ number_format($tax->taxable_value, 0) }}</td>
                    <td>{{ $tax->cgst_rate }}%</td>
                    <td>{{ number_format($tax->cgst_amount, 1) }}</td>
                    <td>{{ $tax->sgst_rate }}%</td>
                    <td>{{ number_format($tax->sgst_amount, 1) }}</td>
                    <td class="text-right"><span class="currency">₹</span> {{ number_format($tax->total_tax, 1) }}</td>
                </tr>
                @endforeach

                <!-- Default tax breakdown if no data provided -->
                @if(empty($tax_breakdown))
                <tr>
                    <td>8504</td>
                    <td>19,800</td>
                    <td>6%</td>
                    <td>1,188</td>
                    <td>6%</td>
                    <td>1,188</td>
                    <td class="text-right"><span class="currency">₹</span> 2,376</td>
                </tr>
                <tr>
                    <td>85414011</td>
                    <td>88,290</td>
                    <td>6%</td>
                    <td>5,297.4</td>
                    <td>6%</td>
                    <td>5,297.4</td>
                    <td class="text-right"><span class="currency">₹</span> 10,594.8</td>
                </tr>
                <tr>
                    <td>-</td>
                    <td>57,576</td>
                    <td>9%</td>
                    <td>5,181.84</td>
                    <td>9%</td>
                    <td>5,181.84</td>
                    <td class="text-right"><span class="currency">₹</span> 10,363.68</td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- Total Amount in Words -->
        <div class="total-words">
            <div class="total-words-title">Total Amount (in words)</div>
            <div>{{ $total_in_words ?? 'One Lakh Eighty Nine Thousand Rupees and Forty Eight Paise' }}</div>
        </div>
    </div>
</body>
</html>
