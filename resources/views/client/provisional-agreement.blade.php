<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Provisional Agreement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #222;
        }
        h1, h2 {
            color: #2c3e50;
        }
        .section {
            margin-bottom: 32px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        th, td {
            border: 1px solid #bbb;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background: #f5f5f5;
        }
        .signature-block {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .signature {
            width: 40%;
            border-top: 1px solid #222;
            text-align: center;
            padding-top: 8px;
        }
    </style>
</head>
<body>
    @php
        $full_name = $customer->first_name . ' ' .  $customer->middle_name  . ' ' .  $customer->last_name;
    @endphp
    <div style="background: #222; color: #fff; padding: 12px 18px; margin-bottom: 32px; border-radius: 6px;">
        <div style="font-weight: bold; text-align: center; font-size: 1.15em; margin-bottom: 4px;">
            Inter Connection agreement (Provisional)
        </div>
        <div style="text-align: center; font-size: 1.08em;">
            (Residential Projects Registered at GEDA / National Portal)
        </div>
        <div style="text-align: center; font-size: 1.08em; margin-top: 4px;">
            Project Registered under New RE Policy-2023
        </div>
    </div>

    <div class="section" style="font-size: 1.08em;">
        <p>
            This Provisional Agreement is made and entered into at
            <span style="font-weight: bold;">{{  strtoupper($customer->district) . ', ' . strtoupper($customer->PerAdd_city) . ',' . strtoupper($customer->PerAdd_state)   }}</span>
            on this <span style="font-weight: bold;">{{ \Carbon\Carbon::parse($solarData->dcr_certification_date)->format('d/m/Y') }}</span>
            between the Consumer, by the name of
            <span style="font-weight: bold;">{{ strtoupper($full_name) }}</span>
            Consumer No. <span style="font-weight: bold;">{{ $customer->customer_number }}</span>
            having premises at
            <span style="font-weight: bold;">
                {{ $customer->customer_address ?? $customer->customer_residential_address ?? 'AT.PO : N.DODISARA, TA: BHILODA ARAVALLI 383355 GUJARAT' }}
            </span>
            (hereinafter referred to as Consumer which expression shall include its permitted assigns and successors) as first party
        </p>
        <p style="font-weight: bold; text-align: center; margin: 18px 0 8px 0;">
            AND
        </p>
        <p>
            Uttar Gujarat Vij Company Limited, a Company registered under the Companies Act 1956/2013 and functioning as the "Distribution Company" or "DISCOM" under the Electricity Act 2003 having its Head Office at, Rajkot (hereinafter referred to as "UGVCL" or "Distribution Licensee" or "DISCOM" which expression shall include its permitted assigns and successors) a Party of the Second Part.
        </p>
        <p style="font-weight: bold; text-align: center; margin: 18px 0 8px 0;">
            AND WHEREAS
        </p>
        <p>
            The solar project of <span style="font-weight: bold;">{{ strtoupper($full_name) }}</span> has been registered on National Portal on date
            <span style="font-weight: bold;">
                {{ \Carbon\Carbon::parse($solarData->registration_date)->format('d/m/Y')  }}
            </span>
            to set up Photovoltaic (PV) based Solar Power Generating Plant (SPG) of
            <span style="font-weight: bold;">
                {{ $project->capacity ?? '3.27 KW' }}
            </span>
            capacity at its premises in legal possession including any rooftop or terrace at
            <span style="font-weight: bold;">
                {{ $customer->customer_address ?? $customer->customer_residential_address }}
            </span>
            , connected with UGVCL's grid at 230 Voltage level for his/her/its own use within the same premises.
        </p>
        <p style="font-weight: bold; text-align: center; margin: 18px 0 8px 0;">
            AND WHEREAS
        </p>
        <p>
            Government of Gujarat has declared Gujarat Renewable Energy Policy 2023 on 4.10.2023 operative for the period starting from the date of notification (4.10.2023) to 30th September 2028. The RE Project installed and commissioned within the operative period shall become eligible for the benefits and incentives as per the policy for a period of 25 years from the date of commissioning or for the life span of the RE Project System whichever is earlier.
        </p>
    </div>


    {{-- Page2 --}}
    <div style="page-break-before: always;"></div>
    <div class="section" style="background: #222; color: #fff; padding: 8px 0; text-align: center; font-weight: bold; font-size: 1.15em;">
        AND WHEREAS
    </div>
    <div style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 18px 24px 18px 24px; border-radius: 4px; margin-bottom: 24px;">
        <p style="margin-bottom: 16px;">
            In order to facilitate commissioning of the solar projects pursuant to notification of new the Gujarat Renewable energy Policy - 2023 effective from 04.10.2023, UGVCL has agreed to sign this agreement on Provisional basis with Consumer in terms of provisions of the Gujarat RE Policy-2023 and its incorporation in the Gujarat Electricity Regulatory Commission (Net Metering Rooftop Solar PV Grid Interactive Systems Regulations) Notification No. 5 of 2016 and its subsequent amendments subject to:
        </p>
        <p style="margin-bottom: 16px;">
            <span style="font-weight: bold;">{{ $full_name }}</span> the first party under the agreement, hereby acknowledges that the present agreement has been entered into by both the parties, taking in to account the notification of new Gujarat RE Policy -2023 and on provisional basis as an interim agreement subject to change as per further <span style="text-decoration: underline;">regulation/direction</span> of the Hon'ble GERC in relation to Gujarat Renewable Energy Policy 2023 and further both parties agree for the requisite modification and amendments in the agreement as per the same, if required. The first party must not dispute the applicability of the GERC order/regulation and must make the required modification and amendments as per the applicable GERC order and Regulation. The settlement will be done <span style="text-decoration: underline;">accordingly.</span>
        </p>
    </div>

    <div class="section" style="background: #222; color: #fff; padding: 8px 0; text-align: center; font-weight: bold; font-size: 1.15em;">
        AND WHEREAS
    </div>
    <div style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 18px 24px 18px 24px; border-radius: 4px;">
        <p style="margin-bottom: 16px;">
            The Distribution Licensee agrees to provide grid connectivity to the Consumer and injection of Solar generated power from his Solar PV System of capacity <span style="font-weight: bold;">{{ $project->capacity ?? '3.27 KW (AC)' }}</span> into the Distribution Licensee’s network, as per conditions of this agreement and as amended from time to time in accordance with applicable Acts / rules/ Regulations/ Codes and orders from time to time, some of which includes: –
        </p>
        <ol style="margin-left: 18px; margin-bottom: 0; padding-left: 18px;">
            <li style="margin-bottom: 6px;"><span style="font-weight: bold;">Government of Gujarat Renewable Energy Policy 2023.</span></li>
            <li style="margin-bottom: 6px;">Central Electricity Authority (Measures relating to Safety and Electric Supply) Regulations, 2010.</li>
            <li style="margin-bottom: 6px;">Central Electricity Authority (Technical Standards for Connectivity to the Grid) Regulations, 2007 as amended from time to time</li>
            <li style="margin-bottom: 6px;">Central Electricity Authority (Installation and Operation of Meters) Regulation 2006.</li>
            <li>Gujarat Electricity Regulatory Commission (Electricity Supply Code &amp; Related Matters) Regulations, 2015.</li>
        </ol>
    </div>


    {{-- Page 3 --}}
    <div style="page-break-before: always;"></div>
    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <ol start="6" style="margin-left: 18px; margin-bottom: 0; padding-left: 18px; list-style-type: decimal;">
            <li style="margin-bottom: 6px;">Gujarat Electricity Regulatory Commission Distribution Code, 2004 and amendments thereto.</li>
            <li style="margin-bottom: 6px;">Instruction, Directions and Circulars issued by Chief Electrical Inspector from time to time.</li>
            <li style="margin-bottom: 6px;">CEA (Technical Standards for connectivity of the Distributed Generation) Regulations, 2013 as amended from time to time.</li>
            <li style="margin-bottom: 6px;">Gujarat Electricity Regulatory Commission (Net Metering Rooftop Solar PV Grid Interactive Systems) Regulations, 2016 as amended from time to time.</li>
        </ol>
        <p style="margin-top: 18px;">
            Both the parties hereby agree as follows:
        </p>
        <div style="margin-top: 18px;">
            <span style="font-weight: bold; text-decoration: underline;">1. Eligibility</span>
            <ol style="margin-left: 18px; margin-bottom: 0; padding-left: 18px; list-style-type: none;">
                <li style="margin-bottom: 6px;">
                    <span style="font-weight: bold;">1.1  </span> Consumer shall own the Solar PV System set up on its own premises or premises in his legal possession.
                </li>
                <li style="margin-bottom: 6px;">
                    <span style="font-weight: bold;">1.2  </span> Consumer needs to consume electricity in the same premises where Solar PV System is set up.
                </li>
                <li>
                    <span style="font-weight: bold;">1.3  </span> Consumer has to meet the standards and conditions as specified in Gujarat Electricity Regulatory Commission Regulations and Central Electricity Authority Regulations and provisions of Government of Gujarat’s Renewable Policy -2023 for being integrated into grid/distribution system.
                </li>
            </ol>
        </div>
        <div style="margin-top: 18px;">
            <span style="font-weight: bold; text-decoration: underline;">2. Technical and Interconnection Requirements</span>
            <ol style="margin-left: 18px; margin-bottom: 0; padding-left: 18px; list-style-type: none;">
                <li style="margin-bottom: 6px;">
                    <span style="font-weight: bold;">2.1</span> Consumer agrees that their Solar PV System and Metering System shall comply with the standards and requirements specified in the Policy, Regulations, and Supply Code, as may be amended from time to time.
                </li>
                <li style="margin-bottom: 6px;">
                    <span style="font-weight: bold;">2.2</span> Consumer agrees that an appropriate metering system(s) shall be installed at the Solar PV System for recording solar generation.
                </li>
                <li>
                    <span style="font-weight: bold;">2.3</span> Consumer agrees that an isolation device has been or will be installed prior to the connection of the Solar Photovoltaic System to the Distribution Licensee's distribution system.
                </li>
            </ol>
        </div>
    </div>


    {{-- Page 4 --}}

    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <ol style="margin-left: 18px; margin-bottom: 0; padding-left: 18px; list-style-type: none;">

            <li style="margin-bottom: 6px;">
                (both automatic and inbuilt within inverter and external manual relays) and agrees for the Distribution Licensee to have access to and operation of this, if required and for repair &amp; maintenance of the distribution system.
            </li>

            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">2.4</span> Consumer agrees that in case of a power outage on Discoms system, solar photovoltaic system will disconnect/isolate automatically and his plant will not inject power into <span style="color: #007bff; text-decoration: underline;">Licensee's</span> distribution system.
            </li>

            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">2.5</span> All the equipment connected to the distribution system shall be compliant with relevant International (IEEE/IEC) or Indian Standards (BIS) and installations of electrical equipment must comply with Central Electricity Authority (Measures of Safety and Electricity Supply) Regulations, 2010 as amended from time to time.
            </li>

            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">2.6</span> Consumer agrees that licensee will specify the interface/inter connection point and metering point.
            </li>

            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">2.7</span> Consumer and licensee agree to comply with the relevant CEA Regulations in respect of operation and maintenance of the plant, drawing and diagrams, site responsibility schedule, harmonics, synchronization, voltage, frequency, flicker etc.
            </li>

            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">2.8</span> In order to full fill Distribution <span style="color: #007bff; text-decoration: underline;">Licensee's</span> obligation to maintain a safe and reliable distribution system, consumer agrees that if it is determined by the Distribution Licensee that consumer's Solar Photovoltaic System either causes damage to or produces adverse effects affecting other consumers or Distribution Licensee's assets, consumer will have to disconnect Solar Photovoltaic System immediately from the distribution system upon direction from the Distribution Licensee and correct the problem to the satisfaction of Distribution Licensee at his own expense prior to reconnection.
            </li>

            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">2.9</span> The consumer shall be solely responsible for any accident to human being/animals whatsoever (fatal/non-fatal) due to back feed from the Solar Photovoltaic System when the grid supply is off and will not be responsible for any accident to human being/animals whatsoever (fatal/non-fatal) due to back feed from the Solar Photovoltaic System when the grid supply is off and will be decided by CEI. The distribution licensee reserves the right to disconnect the consumer's installation at any time in the event of such exigencies to prevent accident or damage to man and material.
            </li>
        </ol>
    </div>


    {{-- Page 5--}}
    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <h2 style="font-size: 1.15em; font-weight: bold; margin-bottom: 12px;">3. Clearances and Approvals</h2>
        <ol style="margin-left: 18px; margin-bottom: 0; padding-left: 18px; list-style-type: none;">
            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">3.1 </span>The Consumer shall obtain all the necessary statutory approvals and clearances (environmental and grid connection related) before connecting the <span style="color: #007bff; text-decoration: underline;">photovoltaic system</span> to the distribution system.
            </li>
        </ol>
    </div>

    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <h2 style="font-size: 1.15em; font-weight: bold; margin-bottom: 12px;">4. Access and Disconnection</h2>
        <ol style="margin-left: 18px; margin-bottom: 0; padding-left: 18px; list-style-type: none;">
            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">4.1</span> Distribution Licensee shall have access to metering equipment and disconnecting means of the Solar Photovoltaic System, both automatic and manual, at all times.
            </li>
            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">4.2</span> In emergency or outage situation, where there is no access to the disconnecting means, both automatic and manual, such as a switch or breaker, Distribution Licensee may disconnect service to the premises of the Consumer.
            </li>
        </ol>
    </div>

    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <h2 style="font-size: 1.15em; font-weight: bold; margin-bottom: 12px;">5. Liabilities</h2>
        <ol style="margin-left: 18px; margin-bottom: 0; padding-left: 18px; list-style-type: none;">
            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">5.1</span> Consumer shall indemnify Distribution Licensee for damages or adverse effects from his negligence or intentional misconduct in the connection and operation of Solar Photovoltaic System.
            </li>
            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">5.2</span> Distribution Licensee shall not be liable for delivery or realization by the Consumer of any fiscal or other incentive provided by the Central/State Government.
            </li>
            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">5.3</span> Distribution Licensee may consider the quantum of electricity generation from the Rooftop Solar PV System owned and operated by individual Residential, Group Housing Societies, and Residential Welfare Association consumers under net metering arrangement towards RPO compliance.
            </li>
        </ol>
    </div>

    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <h2 style="font-size: 1.15em; font-weight: bold; margin-bottom: 12px;">6. Metering:</h2>
        <ol style="margin-left: 18px; margin-bottom: 0; padding-left: 18px; list-style-type: none;">
            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">6.1</span> Metering arrangement shall be as per Central Electricity Authority (Installation And Operation of Meters) Regulations, 2006 as amended from time to time.
            </li>
            <li style="margin-bottom: 6px;">
                <span style="font-weight: bold;">6.2</span> Bi-directional meter shall be installed of same accuracy class as installed before Setting up of Rooftop Solar PV System.
            </li>
        </ol>
    </div>



    {{-- Page 6 --}}
    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <h2 style="font-size: 1.15em; font-weight: bold; margin-bottom: 12px;">7. Commercial Settlement</h2>
        <div style="margin-bottom: 12px;">
            All the commercial settlements under this agreement shall be on provisional basis taking into account the notification of new Gujarat RE policy-2023 and as an interim arrangement subject to change as per further regulation/order/decision of GERC, Gujarat Electricity Regulatory Commission Regulations for Net Metering Rooftop Solar PV Grid Interactive Systems notification no.5 of 2016 and its subsequent amendments.
        </div>
        <div style="margin-bottom: 12px;">
            The commercial settlement will be as follows:
        </div>
        <div style="margin-bottom: 12px;">
            For Residential and common facility connections of Group Housing Societies/Residential Welfare Association consumers:
        </div>
        <ol style="margin-left: 18px; margin-bottom: 0; padding-left: 18px; list-style-type: lower-roman;">
            <li style="margin-bottom: 10px;">
                In case of net import of energy by the consumer from distribution grid during billing cycle, the energy consumed from Distribution Licensee shall be billed as per applicable tariff to respective category of consumers as approved by the Commission from time to time. The energy generated by Rooftop Solar PV System shall be set off against units consumed (not against load/demand) and consumer shall pay demand charges, other charges, penalty etc as applicable to other consumers.
            </li>
            <li style="margin-bottom: 10px;">
                In case of net export of energy by the consumer to distribution grid during billing cycle, Distribution Licensee shall purchase surplus power, after giving set off against consumption during the billing period, at Rs. 2.25/unit for the first 5 years from commissioning date and thereafter for the remaining term of the project at 75% of the average tariff of tariff discovered and contracted in competitive bidding process, discovered by GUVNL for non-park based solar projects for the preceding 6-month period, applicable from April to September or October to March as the case may be, from the commercial operation date (COD) of the project, subject to approval of Hon’ble GERC. Such surplus purchase shall be utilized for meeting RPO of Distribution Licensee. However, fixed / demand charges, other charges, penalty etc shall be payable as applicable to other consumers.
            </li>
        </ol>
        <div style="margin-top: 12px;">
            <em>Provided that in case the consumer is setting up additional solar rooftop capacity under the scheme over and above solar rooftop capacity set up prior to this scheme, surplus energy of entire solar rooftop capacity shall be purchased by Distribution Company at the rate of Rs. 2.25/Unit for the first 5 years from commissioning of project and thereafter for the remaining term of the project at 75% of the simple average of tariff discovered and contracted under competitive bidding process conducted by GUVNL for non-park based solar projects in the preceding 6 month period, i.e. either April to September or October to March as the case may be, from the commercial operation date (COD) of the project, treating earlier agreement as cancelled.</em>
        </div>
    </div>


    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <div style="margin-bottom: 12px;">
            In case of net injection, net amount receivable by consumer in a bill shall be credited in a consumer's account number and adjusted against bill amount payable in subsequent months. However, at the end of year, if net amount receivable by consumer is more than Rs. 100/- and consumer requests for payment, the same may be paid. Such payment shall be made only once in a year based on year end position and request of consumer.
        </div>
    </div>

    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <h2 style="font-size: 1.15em; font-weight: bold; margin-bottom: 12px;">8. Connection Costs:</h2>
        <div>
            The Consumer shall bear all costs related to setting up of Solar Photovoltaic System including metering and inter-connection. The Consumer agrees to pay the actual cost of modifications and/or upgrades to the distribution system or of upgradation of transformer to connect photovoltaic system to the grid in case it is required.
        </div>
    </div>

    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <h2 style="font-size: 1.15em; font-weight: bold; margin-bottom: 12px;">9. Inspection, Test, Calibration and Maintenance prior to connection</h2>
        <div>
            Before connecting, Consumer shall complete all inspections and tests finalized in consultation with the (Name of the Distribution licensee) and if required Gujarat Energy Transmission Corporation Limited (GETCO) to which his equipment is connected. Consumer shall make available to UGVCL all drawings, specifications and test records of the project or the generating station as the case may be.
        </div>
    </div>

    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <h2 style="font-size: 1.15em; font-weight: bold; margin-bottom: 12px;">10. Records:</h2>
        <div>
            Each Party shall keep complete and accurate records and all other data required by each of them for the purposes of proper administration of this Agreement and the operation of the Solar PV System.
        </div>
    </div>


    {{-- New PAge --}}

    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <h2 style="font-size: 1.15em; font-weight: bold; margin-bottom: 12px;">11. Dispute Resolution:</h2>
        <div style="margin-bottom: 10px;">
            <strong>11.1</strong> All disputes or differences between the Parties arising out of or in connection with this Agreement shall be first tried to be settled through mutual negotiation, promptly, equitably and in good faith.
        </div>
        <div style="margin-bottom: 10px;">
            <strong>11.2</strong> In the event that such differences or disputes between the Parties are not settled through mutual negotiations within sixty (60) days or mutually extended period, after such dispute arises, then for
            <ol type="a" style="margin-left: 18px; margin-bottom: 0; padding-left: 18px;">
                <li style="margin-bottom: 6px;">
                    Any dispute in billing pertaining to energy injection and billing amount, would be settled by the Consumer Grievance Redressal Forum and Electricity Ombudsman.
                </li>
                <li>
                    Any other issues pertaining to the Regulations and its interpretation; it shall be decided by the Gujarat Electricity Regulatory Commission following appropriate prescribed procedure.
                </li>
            </ol>
        </div>
    </div>

    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <h2 style="font-size: 1.15em; font-weight: bold; margin-bottom: 12px;">12. Termination</h2>
        <div style="margin-bottom: 10px;">
            <strong>12.1</strong> The Consumer can terminate agreement at any time by giving Distribution Licensee 90 days prior notice.
        </div>
        <div style="margin-bottom: 10px;">
            <strong>12.2</strong> Distribution Licensee has the right to terminate Agreement with 30 days prior written notice, if Consumer commits breach of any of the terms of this Agreement and does not remedy the breach within 30 days of receiving written notice from Distribution Licensee of the breach.
        </div>
        <div>
            <strong>12.3</strong> Consumer shall upon termination of this Agreement, disconnect the Solar Photovoltaic System from Distribution Licensee's distribution system within one week to the satisfaction of Distribution Licensee.
        </div>
    </div>



    <div class="section" style="font-size: 1.05em; color: #222; background: #f5f5f5; padding: 24px 28px 24px 28px; border-radius: 4px;">
        <h2 style="font-size: 1.1em; font-weight: bold; margin-bottom: 12px;">Communication:</h2>
        <div style="margin-bottom: 16px;">
            The names of the officials and their addresses, for the purpose of any communication in relation to the matters covered under this Agreement shall be as under:
        </div>
        <table style="width: 100%; border: 1px solid #bbb; border-collapse: collapse; margin-bottom: 18px;">
            <tr>
                <th style="width: 50%; background: #222; color: #fff; text-align: center; font-weight: bold; padding: 10px;">In respect of the</th>
                <th style="width: 50%; background: #222; color: #fff; text-align: center; font-weight: bold; padding: 10px;">In respect of the consumer</th>
            </tr>
            <tr>
                <td style="vertical-align: top; padding: 18px; min-height: 100px; text-align: center;">
                    <br><br><br><br><br><br>
                    Chief Engineer<br>
                    UGVCL
                </td>
                <td style="vertical-align: top; padding: 18px; min-height: 100px;">
                    {{-- Optionally, you can fill with consumer details --}}
                </td>
            </tr>
        </table>
        <div style="margin-bottom: 16px;">
            IN WITNESS WHEREOF, the Parties hereto have caused this Agreement to be executed by their authorized officers, and copies delivered to each Party, as of the day and year herein above stated.
        </div>
        <table style="width: 100%; border: 1px solid #bbb; border-collapse: collapse;">
            <tr>
                <td style="width: 50%; vertical-align: top; padding: 18px;">
                    <div style="font-weight: bold; margin-bottom: 8px;">FOR AND ON BEHALF OF UGVCL</div>
                    <br><br><br><br><br>
                    <div style="margin-bottom: 18px;">Authorized signatory</div>
                    <div style="font-weight: bold; margin-bottom: 8px;">WITNESSES</div>
                    <br><br><br>
                    <div style="margin-bottom: 8px;">1.<span> _________________________</span></div>
                    <div style="margin-bottom: 8px;">( <span style="visibility: hidden;">................................................ </span> )</div>
                    <br><br>
                    <div style="margin-bottom: 8px;">2.<span> _________________________</span></div>
                    <div style="margin-bottom: 8px;">( <span style="visibility: hidden;">................................................ </span> )</div>
                </td>
                <td style="width: 50%; vertical-align: top; padding: 18px;">
                    <div style="font-weight: bold; margin-bottom: 8px;">FOR AND ON BE HALF OF THE PROJECT OWNER</div>
                    <br><br>
                    <div style="margin-bottom: 4px;">
                        <span style="font-weight: bold;">{{ strtoupper($customer->full_name ?? $full_name) }}</span>
                    </div>
                    <div style="margin-bottom: 18px;">Authorized signatory</div>
                    <div style="font-weight: bold; margin-bottom: 8px;">WITNESSES*</div>
                    <br><div style="margin-bottom: 8px;">1.<br><br><br><br><br>JTENDRAKUMAR BABUBHAI NINAMA</div>
                    <br>
                    <div style="margin-bottom: 8px;">2. <br><br><br><br><br>BHAVESHBHAIBABUBHAI GELANI</div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
