<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Annexure 2 - Model Draft Agreement</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <style>
        @page {
            margin: 20mm 15mm;
        }

        body {
            font-family: Arial, sans-serif;

            color: #000;
            font-size: 11pt;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .page {
            page-break-after: always;
            padding: 0 30px;
        }

        .page:last-child {
            page-break-after: auto;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        h2, h3 {
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
        }

        h2 {
            font-size: 13pt;
        }

        h3 {
            font-size: 12pt;
        }

        p {
            margin: 10px 0;
            text-align: justify;
        }

        ol {
            margin: 10px 0;
            padding-left: 40px;
        }

        ol li {
            margin: 8px 0;
            text-align: justify;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table td {
            vertical-align: top;
            padding: 5px;
        }

        .footer-text {
            text-align: center;
            font-size: 10pt;
            margin-top: 30px;
        }

        .page-number {
            float: right;
            margin-right: 20px;
        }

        .underline {
            text-decoration: underline;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-15 {
            margin-top: 15px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .signature-table {
            margin-top: 30px;
        }

        .signature-table td {
            padding: 10px;
        }

        img {
            max-width: 120px;
        }
    </style>
</head>
<body>

    <!-- Page 1 -->
    <div class="page">
        <div class="center mt-10">
            <strong>Annexure 2</strong>
        </div>

        <div class="center bold mt-15">
            Model Draft Agreement between Consumer & Vendor for installation of grid connected<br>
            rooftop solar (RTS) project under PM – Surya Ghar: Muft Bijli Yojana
        </div>

        <p class="mt-15">
            This agreement is executed on <strong>{{ \Carbon\Carbon::parse($solarData->dcr_certification_date)->format('d/m/Y')  }}</strong> for design, supply, installation, commissioning and 5-year comprehensive maintenance of RTS project/system along with warranty under PM Surya Ghar: Muft Bijli Yojana
        </p>

        <div class="center bold mt-20">Between</div>

        <p class="mt-10">
            <strong>{{ trim(($customerData->first_name ?? '') . ' ' . ($customerData->middle_name ?? '') . ' ' . ($customerData->last_name ?? '')) }}</strong> having address: <strong>
                {{ $customerData->customer_address ?? '_________________' }},
                {{ $customerData->PerAdd_city ?? '_________________' }},
                {{ $customerData->district ?? '_________________' }},
                {{ $customerData->PerAdd_state ?? '_________________' }},
                PIN CODE: {{ $customerData->PerAdd_pin_code ?? '________' }}
            </strong> (hereinafter referred to as first Party i.e. consumer/purchaser/owner of system).
        </p>

        <div class="center bold mt-15">And</div>

        <p class="mt-10">
            <strong>SHIV TRADERS</strong> having registered office at <strong>SHOP NO.04 RAYPUR TA.BHILODA DIST.ARAVALLI</strong> (hereinafter referred to as second Party i.e. Vendor/contractor/ System Integrator).
        </p>

        <div class="center bold mt-15">Whereas</div>

        <p>
            First Party wishes to install a Grid Connected Rooftop Solar Plant on the rooftop of the residential building of the Consumer under PM Surya Ghar: Muft Bijli Yojana.
        </p>

        <div class="center bold mt-15">And whereas</div>

        <p>
            Second Party has verified availability of appropriate roof and found it feasible to install a Grid Connected Roof Top Solar plant and that the second party is willing to design, supply, install, test, commission and carry out Operation & Maintenance of the Rooftop Solar plant for 5 year period
        </p>

        <p class="mt-10">
            On this day, the First Party and Second Party agree to the following:
        </p>

        <p class="bold mt-15">
            The First Party hereby undertakes to perform the following activities:
        </p>

        <div class="footer-text">
            Guidelines for PM-Surya Ghar: Muft Bijli Yojana<br>
            Central Financial Assistance to Residential Consumers
            <span class="page-number">22</span>
        </div>
    </div>

    <!-- Page 2 -->
    <div class="page">
        <ol>
            <li>Submission of online application at National Portal for installation of RTS project/system, Submission of application for net-metering and system inspection and upload of the relevant documents on the National Portal of the scheme</li>

            <li>Provide secure storage of the material of the RTS plant delivered at the premises till handover of the system.</li>

            <li>Provide access to the Roof Top during installation of the plant, operation & maintenance, testing of the plant and equipment and for meter reading from solar meter, inverter etc.</li>

            <li>Provide electricity during plant installation and water for cleaning of the panels.</li>

            <li>Report any malfunctioning of the plant to the Vendor during the warranty period.</li>

            <li>Pay the amount as per the payment schedule as mutually agreed with the vendor, including any additional amount to the second party for any additional work /customization required depending upon the building condition</li>
        </ol>

        <p class="bold mt-15">
            The Second Party hereby undertakes to perform the following activities:
        </p>

        <ol>
            <li>The Vendor must follow all the standards and safety guidelines prescribed under state regulations and technical standards prescribed by MNRE for RTS projects, failing which the vendor is liable for blacklisting from participation in the govt. project/ scheme and other penal actions in accordance with the law. The responsibility of supply, installation and commissioning of the rooftop solar project/system in complete compliance with MNRE scheme guidelines lies with the Vendor.</li>

            <li><strong>Site Survey:</strong> Site visit, survey and development of detailed project report for installation of RTS System. This also includes, feasibility study of roof, strength of roof and shadow free area. If any additional work or customization is involved for the plant installation as per site condition and requirement of the consumer building, the Vendor shall prepare an estimate and can raise separate invoice including GST in addition to the amount towards standard plant cost. The consumer shall pay the amount for such additional work directly to the Vendor.</li>

            <li><strong>Design & Engineering:</strong> Design of plant along with drawings and selection of components as per standard provided by the DISCOM/SERC/MNRE for best performance and safety of the plant.</li>
        </ol>

        <div class="footer-text">
            Guidelines for PM-Surya Ghar: Muft Bijli Yojana<br>
            Central Financial Assistance to Residential Consumers
            <span class="page-number">23</span>
        </div>
    </div>

    <!-- Page 3 -->
    <div class="page">
        <ol start="4">
            <li><strong>Module and Inverter:</strong> The solar modules, including the solar cells, should be manufactured in India. Both the solar modules and inverters shall conform to the relevant standards and specifications prescribed by MNRE. Any other requirement, viz. star labelling (solar modules), quality control orders and standards & labelling (inverters) etc., shall also be complied.</li>

            <li><strong>Procurement & Supply:</strong> Procurement of complete system as per BIS/IS/IEC standard (whatever applicable) & safety guidelines for installation of rooftop solar plants. The supplied materials should comply with all MNRE standards for release of subsidy.</li>

            <li><strong>Installation & Civil work:</strong> Complete civil work, structure work and electrical work (including drawings) following all the safety and relevant BIS standards.</li>

            <li><strong>Documentation (Technical Catalogues/Warranty Certificates/BIS certificates/other test reports etc):</strong> All such documents shall be provided to the consumer for online uploading and submission of technical specifications, IEC/BIS report, Sr. Nos, Warranty card of Solar Panel & Inverter, Layout & Electrical SLD, Structure Design and Drawing, Cable and other detailed documents.</li>

            <li><strong>Project completion report (PCR):</strong> Assisting the consumer in filling and uploading of signed documents (Consumer & Vendor) on the national portal.</li>

            <li><strong>Warranty:</strong> System warranty certificates should be provided to the consumer. The complete system should be warranted for 5 years from the date of commissioning by DISCOM. Individual component warranty documents provided by the manufacturer shall be provided to the consumer and all possible assistance should be extended to the consumer for claiming the warranty from the manufacturer.</li>

            <li><strong>NET meter & Grid Connectivity:</strong> Net meter supply/procurement, testing and approvals shall be in the scope of vendor. Grid connection of the plant shall be in the scope of the vendor.</li>

            <li><strong>Testing and Commissioning:</strong> The vendor shall be present at the time of testing and commissioning by the DISCOM.</li>

            <li><strong>Operation & Maintenance:</strong> Five (5) years Comprehensive Operation and Maintenance including overhauling, wear and tear and regular checking of healthiness of system at proper interval shall be in the scope of vendor. The vendor shall also educate the consumer on best practices for cleaning of the modules and system maintenance.</li>
        </ol>

        <div class="footer-text">
            Guidelines for PM-Surya Ghar: Muft Bijli Yojana<br>
            Central Financial Assistance to Residential Consumers
            <span class="page-number">24</span>
        </div>
    </div>

    <!-- Page 4 -->
    <div class="page">
        <ol start="13">
            <li><strong>Insurance:</strong> Any insurance cost pertaining to material transfer/storage before commissioning of the system shall be in the scope of the vendor.</li>

            <li><strong>Applicable Standard:</strong> The system must meet the technical standards and specifications notified by MNRE. The vendor is solely responsible to supply component and service which meets the technical standards and specification prescribed by MNRE and State DISCOMs.</li>

            <li><strong>Project/system cost & payment terms:</strong> The cost of the plant and payment schedule should be mutually discussed and decided between the vendor and consumer. The consumer may opt for milestone-based payment to the vendor and the same shall be included in the agreement.</li>

            <li><strong>Dispute:</strong> In-case of any dispute between consumer and vendor (in supply/installation/maintenance of system or payment terms), both parties must settle the same mutually or as per law. MNRE/DISCOM shall not be liable for, and would not be a party to any dispute arising between vendor and consumer.</li>

            <li><strong>Subsidy / Project Related Documents:</strong> Vendor must provide all the documents to consumer and help in uploading the same to National Portal for smooth release of subsidy.</li>

            <li><strong>Performance of Plant:</strong> The Performance Ratio (PR) of Plant must be 75% at the time of commissioning of the project by DISCOM or its authorised agency. Vendor must provide (returnable basis) radiation sensor with valid calibration certificate of any NABL / International laboratory at the time of commissioning / testing of the plant. Vendor must maintain the PR of the plant till warranty of project i.e. 5 years from the date of commissioning.</li>
        </ol>


    </div>


    <!-- Page 6 -->
    <div class="page">
        <h3 class="mt-20">19. Mutually Agreed Terms of Payment ...</h3>

        <table class="signature-table">
            <tr>
                <td style="width: 48%;">
                    <strong>First Party</strong><br><br>
                    Name: <strong>{{ trim(($customerData->first_name ?? '') . ' ' . ($customerData->middle_name ?? '') . ' ' . ($customerData->last_name ?? '')) }}</strong><br>
                    Address: <strong>
                        {{ $customerData->customer_address ?? '_________________' }},
                        {{ $customerData->PerAdd_city ?? '_________________' }},
                        {{ $customerData->district ?? '_________________' }},
                        {{ $customerData->PerAdd_state ?? '_________________' }},
                        PIN: {{ $customerData->PerAdd_pin_code ?? '________' }}
                    </strong><br><br>
                    Sign :<br><br><br>
                    Date : <strong>{{ \Carbon\Carbon::parse($solarData->dcr_certification_date)->format('d/m/Y') }}</strong>
                </td>
                <td style="width: 4%;"></td>
                <td style="width: 48%;">
                    <strong>Second Party</strong><br><br>
                    Name: <strong>SHIV TRADERS</strong><br>
                    Address: <strong>RAYPUR</strong><br><br><br><br>
                    Sign :<br>
                    <img src="{{ public_path('assets/img/stamp.png') }}" alt="SHIV TRADERS Stamp" style="margin-top:8px; width:120px;"><br>
                    Date : <strong>{{ \Carbon\Carbon::parse($solarData->dcr_certification_date)->format('d/m/Y') }}</strong>
                </td>
            </tr>
        </table>

        <p class="mt-20">
            <strong>Disclaimer:</strong> This agreement is between vendor and consumer and any dispute related to the same shall not involve any third party including MNRE and Distribution Utilities
        </p>
    </div>

</body>
</html>
