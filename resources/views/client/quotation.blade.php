<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isInvoice ? 'INVOICE' : 'QUOTATION' }} - {{ $quotation->quotation_no ?? '100' }}</title>
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
            font-size: 20px;
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
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .company-details {
            font-size: 14px;
            line-height: 1.3;
        }

        .quotation-details {
            border: 2px solid #000;
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
            font-size: 14px;
        }

        .billing-shipping {
            display: table;
            width: 100%;
            border: 2px solid #000;
            border-top: none;
            margin-bottom: 0;
        }

        .bill-to,
        .ship-to {
            display: table-cell;
            width: 50%;
            padding: 8px;
            vertical-align: top;
            font-size: 14px;
        }

        .ship-to {
            border-left: 1px solid #000;
        }

        .section-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .address {
            font-size: 14px;
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
            font-size: 14px;
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
            font-size: 14px;
        }

        .tax-breakdown th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .total-words {
            border: 2px solid #000;
            border-top: none;
            padding: 5px 8px;
            font-size: 14px;
        }

        .total-words-title {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .currency {
            font-family: 'DejaVu Sans', sans-serif;
        }

        #second-page-table > tr > td > div {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="quotation-container">
        <!-- Header -->
        <div class="header">
            {{ $isInvoice ? 'INVOICE' : 'QUOTATION' }}
        </div>

        @php
            $customerName =
                $quotationData['customer']->first_name .
                ' ' .
                $quotationData['customer']->middle_name .
                ' ' .
                $quotationData['customer']->last_name;
            $solarPanelData = $quotationData['solar_detail'];
            $solarPanelName =
                $solarPanelData['solar_company'] .
                ' ' .
                $solarPanelData['capacity'] .
                ' ' .
                $solarPanelData['solar_type'] .
                ' ' .
                'MODEL';
            $quotationItems = $quotationData['quotation_items']->toArray();
            $documentType = $isInvoice ? 'Invoice' : 'Quotaion';
        @endphp

        <!-- Company Info and Quotation Details -->
        <div style="display: table; width: 100%;">
            <div class="company-info" style="display: table-cell; width: 60%; border-right: none;">
                <div class="company-header">{{ $company->name ?? 'SHIV TRADERS' }}</div>
                <div class="company-details">
                    {{ $company->address ?? 'AT.POST.RAYAPUR TA.BHILODA RAYAPUR DODISARA ROD,' }}<br>
                    {{ $company->city ?? 'Bhiloda' }}, {{ $company->state ?? 'Gujarat' }},
                    {{ $company->pincode ?? '383355' }}<br><br>
                    <strong>GSTIN:</strong> {{ $company->gstin ?? '24AFKPN4643M1Z2' }} &nbsp;&nbsp;
                    <strong>Mobile:</strong> {{ $company->mobile ?? '9998820863' }}<br>
                    <strong>PAN Number:</strong> {{ $company->pan ?? 'AFKPN4643M' }}<br>
                    <strong>Email:</strong> {{ $company->email ?? 'jbninama7233@Gmail.com' }}
                </div>
            </div>
            <div class="quotation-details" style="display: table-cell; width: 40%; border-left: 1px solid #000;">
                <table>
                    <tr>
                        <td><strong>{{ $documentType }} No.</strong></td>
                        <td>{{ str_replace('SQ', 'SI', $quotationData['quotation']->quotation_number) }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ $documentType }} Date</strong></td>
                        <td>{{ \Carbon\Carbon::parse($quotationData['quotation']->date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Expiry Date</strong></td>
                        <td>
                            {{ \Carbon\Carbon::parse($quotationData['quotation']->date)->addMonth()->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Billing and Shipping -->
        <div class="billing-shipping">
            <div class="bill-to">
                <div class="section-title">BILL TO</div>
                <div style="font-weight: bold; margin-bottom: 3px;">{{ $customerName }}</div>
                <div style="font-weight: bold; margin-bottom: 3px;">{{ $quotationData['customer']->mobile }}</div>
                <div class="address">
                    <strong>Address:</strong>
                    {{ $quotationData['customer']->customer_address ?? 'AT PO-N.DODISARA, TA.BHILODA' }}, District:
                    {{ $quotationData['customer']->district ?? 'Arvalli' }}, State:
                    {{ $quotationData['customer']->PerAdd_state ?? 'GUJARAT' }}, PIN Code:
                    {{ $quotationData['customer']->PerAdd_pin_code ?? '383355' }}
                </div>
            </div>
            <div class="ship-to">
                <div class="section-title">SHIP TO</div>
                <div style="font-weight: bold; margin-bottom: 3px;">{{ $customerName }}</div>
                <div style="font-weight: bold; margin-bottom: 3px;">{{ $quotationData['customer']->mobile }}</div>
                <div class="address">
                    <strong>Address:</strong>
                    {{ $quotationData['customer']->customer_address ?? 'AT PO-N.DODISARA, TA.BHILODA' }}, District:
                    {{ $quotationData['customer']->district ?? 'Arvalli' }}, State:
                    {{ $quotationData['customer']->PerAdd_state ?? 'GUJARAT' }}, PIN Code:
                    {{ $quotationData['customer']->PerAdd_pin_code ?? '383355' }}
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
                @php
                    $items = $quotationData['quotation_items'] ?? [];
                    $totalTax = 0;
                    $grandTotal = 0;
                @endphp
                @forelse($items as $index => $item)
                    @php
                        $amount = ($item->rate ?? 0) * ($item->quantity ?? 0);
                        $taxAmount = $amount * (($item->tax ?? 0) / 100);
                        $total = $amount + $taxAmount;
                        $totalTax += $taxAmount;
                        $grandTotal += $total;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="text-left">{{ $item->item_name ?? '-' }}</td>
                        <td>{{ $item->hsn ?? '-' }}</td>
                        <td>{{ $item->quantity ?? '-' }}</td>
                        <td class="text-right">{{ number_format($item->rate ?? 0, 2) }}</td>
                        <td class="text-right">
                            {{ number_format($taxAmount, 2) }}<br>
                            <small>({{ $item->tax ?? 0 }}%)</small>
                        </td>
                        <td class="text-right">{{ number_format($total, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No items found.</td>
                    </tr>
                @endforelse


                <tr class="total-row">
                    <td colspan="5" style="text-align: center;"><strong>TOTAL</strong></td>
                    <td class="text-right"><strong><span class="currency">Rs. </span>
                            {{ number_format($totalTax, 2) }}</strong></td>
                    <td class="text-right"><strong><span class="currency">Rs. </span>
                            {{ number_format($grandTotal, 2) }}</strong></td>
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
                @php
                    $quotationItems = $quotationData['quotation_items'] ?? [];
                    $totalTax = 0;
                    $grandTotal = 0;
                @endphp
                @foreach ($quotationItems ?? [] as $quotationItem)
                    @php
                        $itemTaxableValue = round($quotationItem->quantity * $quotationItem->rate, 2);
                        $cgstRate = $quotationItem->tax / 2;
                        $sgstRate = $quotationItem->tax / 2;
                        $cgstAmount = round( ($itemTaxableValue * $cgstRate) / 100 ,2);
                        $sgstAmount = round( ($itemTaxableValue * $sgstRate) / 100 ,2);
                        $totalTaxForEachItem = round(($quotationItem->quantity * $quotationItem->rate * $quotationItem->tax) / 100, 2);
                    @endphp
                    <tr>
                        <td>{{ $quotationItem->hsn }}</td>
                        <td>{{ $itemTaxableValue }}</td>
                        <td>{{ $cgstRate . '%' }}</td>
                        <td>{{ $cgstAmount }}</td>
                        <td>{{ $sgstRate . '%' }}</td>
                        <td>{{ $sgstAmount }}</td>
                        <td>{{ $totalTaxForEachItem }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $totalAmountWithTax = 0;
            foreach ($quotationData['quotation_items'] as $quotationItem) {
                $itemTaxableValue = $quotationItem->quantity * $quotationItem->rate;
                $itemTax = ($itemTaxableValue * $quotationItem->tax) / 100;
                $totalAmountWithTax += $itemTaxableValue + $itemTax;
            }
        @endphp

        <!-- Total Amount in Words -->
        <div class="total-words">
            <div class="total-words-title">Total Amount (in words)</div>
            @php
                // Split integer and decimal part
                $integerPart = floor($totalAmountWithTax);
                $decimalPart = round(($totalAmountWithTax - $integerPart) * 100);

                // Create formatter for integer and decimal part
                $fmt = new \NumberFormatter('en_IN', \NumberFormatter::SPELLOUT);

                // Convert integer part
                $integerWords = ucwords($fmt->format($integerPart));

                // Convert decimal part as words (always two digits)
                $decimalPartStr = str_pad((string) $decimalPart, 2, '0', STR_PAD_LEFT);
                $decimalWordsArr = [];
                foreach (str_split($decimalPartStr) as $digit) {
                    $decimalWordsArr[] = ucwords($fmt->format((int)$digit));
                }
                $decimalWords = implode(' ', $decimalWordsArr);
            @endphp
            <div>
                {{ $integerWords }} Rupees
                @if($decimalPart > 0)
                    And {{ $decimalWords }} Paise
                @endif
                Only
            </div>
            {{-- <div>
                {{ ucwords(\NumberFormatter::create('en_IN', \NumberFormatter::SPELLOUT)->format($totalAmountWithTax)) }}
            </div> --}}
        </div>
    </div>

    <div style="page-break-before: always;"></div>
    <div style="width: 100%; margin-top: 20px;">
         <!-- Header -->
         <div class="header">
            {{ $isInvoice ? 'INVOICE' : 'QUOTATION' }}
        </div>
        <table id="second-page-table" style="width: 100%; border-collapse: collapse; border: 1px solid #000; line-height: 1.5; font-size: 14px;">
            <tr>
                <!-- Bank Details Column -->
                <td
                    style="width: 30%; vertical-align: top; border-right: 1px solid #000; padding: 10px; font-size: 12px;">
                    <div style="margin-top: 8px; font-size: 14px;">
                    <h3>Bank Details</h3><br>

                    </div>
                    <div style="margin-top: 8px; font-size: 14px;">
                        <strong>Name:</strong> {{ $company->name ?? 'SHIV TRADERS' }}<br>
                        <strong>IFSC Code:</strong> {{ $company->ifsc ?? 'UBIN0802457' }}<br>
                        <strong>Account No:</strong> {{ $company->account_no ?? '042301000016650' }}<br>
                        <strong>Bank:</strong> {{ $company->bank_name ?? 'Axis Bank BHILODA BAZAR MAMNRADA' }}
                    </div>
                </td>
                <!-- Terms and Conditions Column -->
                <td
                    style="width: 50%; vertical-align: top; border-right: 1px solid #000; padding: 10px; font-size: 12px;">
                    <div style="margin-top: 8px; font-size: 14px;">
                        <h3>Terms and Conditions:-</h3>
                        <ul style="padding-left: 18px; font-size: 11px; margin-top: 6px; list-style-type: disc; font-size: 14px;">
                            <li>In the case of natural disaster Panel or any material damage is not acceptable in warranty.</li>
                            <li>Above prices are inclusive of GST and Transportation.</li>
                            <li>Transit insurance belongs to us GST 13.8% Including all tax.</li>
                            <li>
                                The cost of system strengthening by DISCOM, if any as may be decided by the Discom upon the technical feasibility of client premises for grid connectivity shall be borne by consumer (As above the quotation)
                                <br>
                                (Such as meter shifting/MCB/LLCB/ELCB/extra wiring/Meter Earthing/Mounting structure as wall/weather shed)
                            </li>
                            <li>
                                The client has to provide the following:
                                <ol style="padding-left: 18px; font-size: 14px; margin-top: 6px;">
                                    <li>The shadow free area for installation of SPV module.</li>
                                    <li>Permission for structure fitting with anchor fastening on the terrace and side walls.</li>
                                    <li>Provide safe space for earthing without any underground piping or cabling. If in case the entire compound is paved the client have to make opening for earthing at a specified space.</li>
                                </ol>
                            </li>
                            <li>The DISOM registration fees are extra to be paid against meter estimate. (As above in quotation)</li>
                            <li>The standard length of all wire/cable will be 30 meters only. Beyond 30 meters length, wiring charges to be paid extra.</li>
                            <li>The cost of all the extra/additional material or work or additional length of wires/cables will be charged extra (As above in quotation)</li>
                            <li>After approval of documents and receipt of confirmation if the order is cancelled penalty to paid by client as per Tender terms and paid estimate charges will be forfeited.</li>
                            <li>If any problem due to mis-match of documents and other related issued then the company will be not responsible for delay in work.</li>
                        </ul>
                    </div>
                </td>
                <!-- Signature Column -->
                <td style="width: 20%; vertical-align: top; text-align: center; padding: 10px; font-size: 12px;">
                    <div style="margin-top: 40px;">
                        <div style="margin-top: 10px; font-size: 14px;">
                            <span style="font-size: 14px;">Authorised Signatory For</span><br>
                            <strong>{{ $company->name ?? 'SHIV TRADERS' }}</strong>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
