<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PCR Report</title>
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
    <h1>PCR (Project Completion Report)</h1>

    <div>
        <p>
            This is to certify that the installation of Solar rooftop power plant along with its associated equipment of
            capacity ({{ $project->number_of_panels }} no. of panels) X ({{ $project->panel_voltage }} W peak wattage capacity per unit) = {{ $project->capacity }} KW total capacity has been
            carried out by us/me and the details of the Installation, as well as the test results, are as under:
        </p>
    </div>


    <div class="section">
        <h2>1. Details Of Consumer :</h2>
        <table>
            <tr>
                <th style="width: 30%;">Name:</th>
                <td style="width: 40%;">{{ $customer->first_name . ' ' . $customer->middle_name . ' ' . $customer->last_name }}</td>
                <th style="width: 30%;" rowspan="3">AT PO:-N.DODISARA, TA.BHILODA.,<br> DISTRICT: ARVALLI, STATE: GUJARAT,<br> PIN Code: 383355</th>
            </tr>
            <tr>
                <th>Electricity Connection No:</th>
                {{-- TODO need dynamic data --}}
                <td>29401138249</td>
            </tr>
            <tr>
                <th>National Portal Reg. no:</th>
                {{-- TODO need dynamic data --}}
                <td>NP-GJUG25-7586979</td>
            </tr>
        </table>
    </div>
    <div class="section">
        <h2>2. Details Of Solar PV cells and Inverter</h2>
        <table>
            <tr>
                <th>No.</th>
                <th>Particular</th>
                <th>Solar PV Module</th>
                <th>Inverter</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Solar Panel company</td>
                <td>{{ $project->solar_company }}</td>
                <td>{{ $project->inverter_company }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Capacity</td>
                <td>{{ $project->capacity ? $project->capacity  : 'N/A' }} WP</td>
                <td>{{ $project->inverter_capacity ? $project->inverter_capacity : 'N/A' }} kw</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Voltage</td>
                <td>{{ $project->panel_voltage ? $project->panel_voltage . ' V DC' : 'N/A' }} C</td>
                <td>-</td>
            </tr>
            <tr>
                <td>4</td>
                <td>No. of Modules/Inverter</td>
                <td>{{ $project->number_of_panels ?? 'N/A' }}</td>
                <td>1</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Total Capacity</td>
                <td>{{ $project->capacity ? $project->capacity : 'N/A' }} WP</td>
                <td>{{ $project->inverter_capacity }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td>SR Number</td>
                <td>{{ $project->panel_serial_numbers ?? 'Attached Separate Sheet' }}</td>
                <td>{{ $project->inverter_serial_number ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <div style="page-break-before: always;"></div>
    <div class="section">
        <h2>3. Test Results</h2>
        <table style="width: 100%; border: 1px solid #bbb; border-collapse: collapse;">
            <tr>
                <th style="padding: 6px 10px; border: 1px solid #bbb; font-weight: normal; text-align: left;">Earthing</th>
                <th style="padding: 6px 10px; border: 1px solid #bbb; font-weight: normal; text-align: left;">Insulation Resistance</th>
            </tr>
            <tr>
                <td style="vertical-align: top; border: 1px solid #bbb; padding: 6px 10px;">
                    <span>Earth Tester SR No: <span>24104657</span></span><br>
                    <span style="font-weight: bold;">Earth Resistance values for all Earth Pits-</span>
                    <ol style="margin: 6px 0 0 18px; padding-left: 0;">
                        <li>1.15 ohm</li>
                        <li><u>1.26 ohm</u></li>
                        <li>1.19 ohm</li>
                        <li>&nbsp;</li>
                    </ol>
                </td>
                <td style="vertical-align: top; border: 1px solid #bbb; padding: 6px 10px;">
                    <span>Meggar SR No: and Voltage: <span>24104587</span></span><br>
                    <span style="font-weight: bold;">Insulation Resistance :</span>
                    <ol style="margin: 6px 0 0 18px; padding-left: 0;">
                        <li>Phase to Phase: 115MOhm</li>
                        <li>Phase to Earth: 109M ohm</li>
                    </ol>
                </td>
            </tr>
        </table>
        <div style="margin-top: 16px;">
            The work of the aforesaid installation has been completed by us on {{ \Carbon\Carbon::parse($project->updated_at)->format('d-m-Y') }} and it is hereby declared that
            <ol type="a" style="margin-top: 8px;">
                <li>
                    All PV modules and their supporting structures have enough mechanical strength, and they conform to the relevant codes/guidelines prescribed on this behalf.
                </li>
                <li>
                    All cables/wires, protective switchgears as well as Earthings are of adequate ratings/size and they conform to the requirements of the Central Electricity Authority (Measures relating to safety and electrical supply), Regulations 2010, as well as the relevant codes/guidelines prescribed in this regard.
                </li>
                <li>
                    The work of the aforesaid installation has been carried out in conformance with the requirements of Central Electricity Authority (Measures relating to safety and electrical supply), Regulations 2010 and the relevant codes/guidelines prescribed in this behalf. The installation is tested by us and is found safe to be energised.
                </li>
            </ol>
        </div>
    </div>


    <div class="section" style="margin-top: 32px;">
        <table style="width: 100%; border: 1px solid #bbb; border-collapse: collapse;">
            <tr>
                <td style="vertical-align: top; width: 50%; padding: 12px;">
                    <div>
                        <strong>Date:</strong>{{ \Carbon\Carbon::parse($project->updated_at)->format('d-m-Y') }}<br>
                        <strong>Name of Electrical Supervisor</strong><br>
                        RANJITBHAI MAKSJIBHAI DUND<br>
                        Permit No. – GJ/ARV/C-05701<br><br>
                        Signature of Electrical Supervisor
                    </div>
                </td>
                <td style="vertical-align: top; width: 50%; padding: 12px;">
                    <div>
                        <strong>Date:</strong>{{ \Carbon\Carbon::parse($project->updated_at)->format('d-m-Y') }}<br>
                        <strong>Name of Licensed Electrical Contractor</strong><br>
                        SHIV TRADERS<br>
                        Electrical Contractor License no G/S/A-21168<br>
                        Valid up to 19.04.2025 To 18.04.2030<br>
                        Signature of Licensed Electrical Contractor-<br>
                        @php
                            // Use the asset helper to get the public URL for the image instead of the server path
                            $stampPath = public_path('assets/img/stamp.png');
                            $stampUrl = asset('assets/img/stamp.png');
                        @endphp
                        @if(file_exists($stampPath))
                            <img src="{{ $stampPath }}" alt="SHIV TRADERS Stamp" style="margin-top: 8px; width: 120px;">
                        @else
                            <span style="color: red;">[Stamp image not found]</span>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </div>





    <div class="section" style="margin-top: 32px;">


        {{-- <h2 style="margin-bottom: 8px;">DETAILS OF SOLAR PV MODULE AND INVERTER1</h2>
        <table style="width: 100%; border: 1px solid #bbb; border-collapse: collapse; margin-bottom: 0;">
            <tr>
                <th style="width: 5%;">SR NO.</th>
                <th style="width: 25%;">DETAILS</th>
                <th style="width: 35%;">SOLAR PV MODULE</th>
                <th style="width: 35%;">INVERTER</th>
            </tr>
            <tr>
                <td style="text-align: center;">A</td>
                <td>MAKE</td>
                <td>{{ $project->solar_company ?? 'N/A' }}</td>
                <td>{{ $project->inverter_company ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="text-align: center;">B</td>
                <td>CAPACITY</td>
                <td>
                    @if(!empty($project->panel_capacity))
                        {{ $project->panel_capacity }} WP
                    @elseif(!empty($project->capacity))
                        {{ $project->capacity }} WP
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if(!empty($project->inverter_capacity))
                        {{ $project->inverter_capacity }} kW
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">C</td>
                <td>VOLTAGE</td>
                <td>
                    @if(!empty($project->panel_voltage))
                        {{ $project->panel_voltage }} V DC
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if(!empty($project->inverter_voltage))
                        {{ $project->inverter_voltage }} V AC
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">D</td>
                <td>TOTAL NOS.</td>
                <td>
                    {{ $project->number_of_panels ?? 'N/A' }}
                </td>
                <td>
                    {{ $project->number_of_inverters ?? $products->where('product_category_id', 2)->count() }}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">E</td>
                <td>TOTAL CAPACITY</td>
                <td>
                    @if(!empty($project->capacity))
                        {{ $project->capacity }} KW
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if(!empty($project->inverter_capacity))
                        {{ $project->inverter_capacity }} KW
                    @else
                        N/A
                    @endif
                </td>
            </tr>
        </table> --}}

        @php
            // Separate solar panel and inverter serial numbers
            $panelSerials = [];
            $inverterSerials = [];
            foreach ($products as $product) {
                if ($product->product_category_id == 1) {
                    $panelSerials[] = $product->serial_number;
                } elseif ($product->product_category_id == 2) {
                    $inverterSerials[] = $product->serial_number;
                }
            }
            $maxRows = max(count($panelSerials), count($inverterSerials));
        @endphp

        <h2></h2>
        <br>

        <div style="background: #222; color: #fff; padding: 8px 12px; font-size: 1.1em; margin-bottom: 12px;">
            <p>
                NAME OF USER: <span style="font-weight: bold;">{{ $customer->first_name . ' ' . $customer->middle_name . ' ' . $customer->last_name }}</span>

            </p>
            <p>
                NATIONAL PORTAL REG. NO: <span style="font-weight: bold;">NP-GJUG25-7586979</span>
            </p>

        </div>
        @if ($maxRows > 0)


            {{-- <div style="background: #222; color: #fff; padding: 8px 12px; border-top: 1px solid #fff;">
                {{ $customer->first_name . ' ' . $customer->middle_name . ' ' . $customer->last_name }}<br>
                <span style="font-size: 0.95em;">
                    {{ $customer->PerAdd_city }}, Dist.-{{ $customer->district }}, {{ $customer->PerAdd_state }}-{{ $customer->PerAdd_pin_code }}
                </span>
            </div> --}}


            <h2>Serial Numbers</h2>


            <table style="width: 100%; border: 1px solid #bbb; border-collapse: collapse; margin-bottom: 0;">

                <tr>
                    <th style="width: 5%;">SR NO.</th>
                    <th style="width: 5%;">Details</th>
                    <th style="width: 35%;">SOLAR PV MODULE</th>
                    <th style="width: 35%;">INVERTER</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Solar Panel company</td>
                    <td>{{ $project->solar_company }}</td>
                    <td>{{ $project->inverter_company }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Capacity</td>
                    <td>{{ $project->capacity ? $project->capacity  : 'N/A' }} WP</td>
                    <td>{{ $project->inverter_capacity ? $project->inverter_capacity : 'N/A' }} kw</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Voltage</td>
                    <td>{{ $project->panel_voltage ? $project->panel_voltage . ' V DC' : 'N/A' }} C</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>No. of Modules/Inverter</td>
                    <td>{{ $project->number_of_panels ?? 'N/A' }}</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Total Capacity</td>
                    <td>{{ $project->capacity ? $project->capacity : 'N/A' }} WP</td>
                    <td>{{  $project->inverter_capacity }}</td>
                </tr>

                @for ($i = 0; $i < $maxRows; $i++)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td> - </td>
                        <td>{{ isset($panelSerials[$i]) ? $panelSerials[$i] : '-' }}</td>
                        <td>{{ isset($inverterSerials[$i]) ? $inverterSerials[$i] : '-' }}</td>
                    </tr>
                @endfor
            </table>
        @endif

    </div>
</body>

</html>
