<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Voucher</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #000;
            padding: 30px;
            font-size: 14px;
        }

        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid black;
            padding: 15px;
        }

        .header {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .header-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .header-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: right;
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .company-address {
            font-size: 12px;
            line-height: 1.4;
            margin-bottom: 3px;
        }

        .gstin {
            font-size: 12px;
            margin-top: 8px;
        }

        .receipt-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .receipt-info {
            text-align: right;
        }

        .receipt-info-row {
            margin-bottom: 5px;
            font-size: 13px;
        }

        .receipt-info-label {
            display: inline-block;
            width: 140px;
            text-align: left;
        }

        .receipt-info-value {
            display: inline-block;
            text-align: right;
            min-width: 100px;
        }

        .payment-from-section {
            margin: 40px 0;
        }

        .payment-from-label {
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 8px;
            background: #f5f5f5;
            padding: 5px 10px;
            display: inline-block;
        }

        .payment-from-name {
            font-size: 14px;
            margin-left: 10px;
        }

        .amount-section {
            margin: 40px 0;
        }

        .total-row {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .total-label {
            display: inline-block;
            width: 120px;
        }

        .total-value {
            font-weight: bold;
        }

        .amount-words-row {
            font-size: 13px;
            margin-top: 3px;
        }

        .amount-words-label {
            display: inline-block;
        }

        .amount-words-value {
            display: inline-block;
        }

        .signature-section {
            margin-top: 80px;
            text-align: right;
        }

        .signature-box {
            display: inline-block;
            text-align: center;
            min-width: 250px;
        }

        .signature-label {
            font-size: 12px;
            margin-bottom: 50px;
        }

        .signature-image {
            margin-bottom: 10px;
            min-height: 40px;
        }

        .signature-company {
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- Header Section -->
        <div class="header">
            <div class="header-left">
                <div class="company-name">SHIV TRADERS</div>
                <div class="company-address">AT.POST.RAYAPUR TA.BHILODA RAYAPUR DODISARA ROD</div>
                <div class="company-address">Bhiloda ,Gujarat ,383355</div>
                <div class="gstin">GSTIN : 24AFKPN4643M1Z2</div>
            </div>
            <div class="header-right">
                <div class="receipt-title">Receipt Voucher</div>
                <div class="receipt-info">
                    <div class="receipt-info-row">
                        <span class="receipt-info-label">Payment Number:</span>
                        <span class="receipt-info-value">{{ $solarDetail->id }}</span>
                    </div>
                    <div class="receipt-info-row">
                        <span class="receipt-info-label">Payment Date :</span>
                        <span class="receipt-info-value">{{ \Carbon\Carbon::parse($solarDetail->meter_payment_date)->format('d/m/Y') }}</span>
                    </div>
                    <div class="receipt-info-row">
                        <span class="receipt-info-label">Payment Mode :</span>
                        <span class="receipt-info-value">Cash/Online</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment From Section -->
        <div class="payment-from-section">
            @php
                $customerName = $customer->first_name . ' ' . $customer->middle_name . ' ' .  $customer->last_name;
            @endphp
            <div class="payment-from-label">PAYMENT FROM</div>
            <div class="payment-from-name">
                {{ $customerName }}
            </div>
        </div>

        <!-- Amount Section -->
        <div class="amount-section">
            <div class="total-row">
                <span class="total-label">Total :   <b>Rs.  {{ $solarDetail['meter_payment_amount'] }}</b></span>
            </div>
            <div class="amount-words-row">
                <span class="amount-words-label">Amount Paid In Words:</span><br>
                @php
                    // Get the amount
                    $amount = (float)($solarDetail['meter_payment_amount'] ?? 0);

                    // Split integer and decimal part
                    $integerPart = floor($amount);
                    $decimalPart = round(($amount - $integerPart) * 100);

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
                <span class="amount-words-value">
                    {{ $integerWords }} Rupees
                    @if($decimalPart > 0)
                        And {{ $decimalWords }} Paise
                    @endif
                    Only
                </span>
                <span class="amount-words-value"></span>
            </div>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-label">Authorized signatory for</div>
                <div class="signature-image">
                    <img src="{{ asset('signatures/signature.png') }}" alt="Signature" style="max-height: 50px;">
                </div>
                <div class="signature-company">SHIV TRADERS</div>
            </div>
        </div>
    </div>
</body>
</html>
