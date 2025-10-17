<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UGVCL Meter Change Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #222;
        }

        h1,
        h2 {
            color: #2c3e50;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
        }

        th,
        td {
            border: 1px solid #bbb;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background: #f5f5f5;
        }

        .section {
            margin-bottom: 32px;
        }
    </style>
</head>
<body>
    <div class="header" style="text-align: right;">
        <div class="header-title white">SHIV TRADERS</div>
        <div class="date-label">DATE : {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
    </div>
    <div class="content">
        <p class="">To<br>
            UGVCL SUB-DIVISION,<br>
            <span class="bold"><b>{{ $solarDetail['discom_name'] }}</b></span><br>
            <span class="bold"><b>{{ $solarDetail['discom_division'] }}</b></span><br>
        </p>
        <p class="">Consumer No. <span class="bold"><b>{{ $customer['customer_number'] }}</b></span></p>
        <br>
        <p class=""><strong>SUBJECT: REQUEST FOR CHANGE THE METER & INSTALLATION THE SOLAR (BI-DIRECTIONAL 1 METER)</strong></p>
        <p class="">Respected Sir,</p>
        <p class="">
            We Would Like to Introduce Ourselves As shiv traders We Are Channel Partner Of UGVCL for (Residential Solar Roof Top Project)
        </p>
        <p class="">
            With Reference to Above Mention Subject, We Are Requesting to You, Please Change the Meter and Installation for Solar (Bi-Directional) Meter for the Solar System at Below Mentioned Address
        </p>
        <br>
        @php
            $customerFullName = $customer['first_name'] . ' ' . $customer['middle_name'] . ' ' . $customer['last_name'];
        @endphp
        <p class=""><span class="bold">NAME : {{ $customerFullName }} </span></p>
        <p class="">
            <span class="address">
                ADDRESS: {{ $customer['customer_residential_address'] ?? 'N/A' }},
                {{ $customer['PerAdd_city'] ?? 'N/A' }},
                {{ $customer['district'] ?? 'N/A' }},
                {{ $customer['PerAdd_state'] ?? 'N/A' }}, <br>
                PINCODE: {{ $customer['PerAdd_pin_code'] ?? 'N/A' }}, <br>
                ALL REQUIRED DOCS ARE ATTACHED.
            </span>
        </p>
        <ul>
            <li>1) IPRA</li>
            <li>2) PCR</li>
            <li>3) METER PAYMENT RECEIPT</li>
            <li>4) SITE PHOTO WITH GEO TAG</li>
            <li>5) NP AGREEMENT</li>
            <li>6) BANK DETAILS</li>
            <li>7) INSTALLATION DETAILS</li>
        </ul>
        <p>THANKS & REGARDS<br>
        SHIV TRADERS</p>
    </div>
    <br><br>
    <div class="footer" style="text-align: center;">
        <div class="highlight bold">SHIV TRADERS</div>
        <div>SHOP NO-4 RAYPUR, TA:BHILODA ,DIST:ARVALLI, GUJARAT 383355</div>
    </div>
</body>
</html>

