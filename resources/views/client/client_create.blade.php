<form action="javascript:void(0)" id="customerForm" name="customerForm" class="form-horizontal" method="POST"
    enctype="multipart/form-data">
    <input type="hidden" id="clientId" name="clientId" value="{{ $clientId ?? '' }}">
    <h5 class="fw-bold mb-3 mt-4">👤 Customer Basic Details</h5>
    <div class="row">
        <!-- First Name -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" />
                <label for="first_name">First Name <span class="text-danger">*</span></label>
                <span class="text-danger" id="first_name-error"></span>
            </div>
        </div>

        <!-- Middle Name -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="middle_name" id="middle_name"
                    placeholder="Middle Name" />
                <label for="middle_name">Middle Name</label>
                <span class="text-danger" id="middle_name-error"></span>
            </div>
        </div>

        <!-- Last Name -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" />
                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                <span class="text-danger" id="last_name-error"></span>
            </div>
        </div>
        <!-- Email Address -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" />
                <label for="email">Email Address <span class="text-danger">*</span></label>
                <span class="text-danger" id="email-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="age" id="age" placeholder="Age" />
                <label for="age">Age <span class="text-danger">*</span></label>
                <span class="text-danger" id="age-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="gender" id="gender">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <label for="gender">Gender <span class="text-danger">*</span></label>
                <span class="text-danger" id="gender-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="marital_status" id="marital_status">
                    <option value="">Select Marital Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                </select>
                <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                <span class="text-danger" id="marital_status-error"></span>
            </div>
        </div>
        <!-- PAN Number -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="pan_number" id="pan_number" maxlength="10" minlength="10"
                    placeholder="PAN Number" />
                <label for="pan_number">PAN Number <span class="text-danger">*</span></label>
                <span class="text-danger" id="pan_number-error"></span>
            </div>
        </div>
        <!-- Aadhar Number -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="aadhar_number" id="aadhar_number" maxlength="12" minlength="12"
                    placeholder="Aadhar Number" />
                <label for="aadhar_number">Aadhar Number <span class="text-danger">*</span></label>
                <span class="text-danger" id="aadhar_number-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="tel" class="form-control" name="mobile" id="mobile" maxlength="10"
                    placeholder="Aadhar-linked Mobile" />
                <label for="mobile">Aadhar-linked Mobile <span class="text-danger">*</span></label>
                <span class="text-danger" id="mobile-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="tel" class="form-control" name="alternate_mobile" id="alternate_mobile"
                    maxlength="10" placeholder="Alternate Mobile" />
                <label for="alternate_mobile">Alternate Mobile</label>
                <span class="text-danger" id="alternate_mobile-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" id="PerAdd_state" name="PerAdd_state">
                    <option value="">Select State</option>
                </select>
                <label for="PerAdd_state">State <span style="color:red">*</span></label>
                <span class="text-danger" id="PerAdd_state-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input class="form-control" type="text" id="district" name="district" placeholder="District" />
                <label for="district">District <span style="color:red">*</span></label>
                <span class="text-danger" id="district-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input class="form-control" type="text" id="PerAdd_city" name="PerAdd_city"
                    placeholder="City" />
                <label for="city">City <span style="color:red">*</span></label>
                <span class="text-danger" id="PerAdd_city-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input class="form-control" type="number" id="PerAdd_pin_code" name="PerAdd_pin_code" maxlength="8" minlength="6"
                    placeholder="Pin Code" />
                <label for="pin_code">Pin Code <span style="color:red">*</span></label>
                <span class="text-danger" id="PerAdd_pin_code-error"></span>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border rounded p-3">
                <h6 class="fw-bold mb-3"><i class="mdi mdi-home-map-marker me-1 text-primary"></i>Permanent Address
                </h6>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <textarea class="form-control" name="customer_address" id="customer_address"
                            placeholder="Enter full permanent address"
                            style="height: 100px; resize: vertical; border-radius: 8px; box-shadow: none;"></textarea>
                        <span class="text-danger" id="customer_address-error"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border rounded p-3">
                <h6 class="fw-bold mb-3"><i
                        class="mdi mdi-map-marker-radius-outline me-1 text-primary"></i>Residential Address</h6>
                <div class="col-md-12 mb-2 d-flex align-items-center">
                    <input class="form-check-input me-2" type="checkbox" id="sameAsPermanent"
                        style="transform: scale(1.2);">
                    <label class="form-check-label fw-medium" for="sameAsPermanent" style="cursor:pointer;">
                        <i class="mdi mdi-checkbox-marked-circle-outline text-success me-1"></i>
                        Same as Permanent Address
                    </label>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <textarea class="form-control" name="customer_residential_address" id="customer_residential_address"
                            placeholder="Enter full residential address"
                            style="height: 100px; resize: vertical; border-radius: 8px; box-shadow: none;"></textarea>
                        <span class="text-danger" id="customer_residential_address-error"></span>
                    </div>
                </div>
            </div>
        </div>
        <style>
            /* Optional: Add some hover/focus effect for better UX */
            textarea.form-control:focus {
                border-color: #0d6efd;
                box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .15);
            }
        </style>
    </div>
    <h5 class="fw-bold mb-3 mt-4">🧾 Quotation</h5>
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="quotation_" id="quotation_">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
                <label for="quotation_">Is Quotation <span class="text-danger">*</span></label>
                <span class="text-danger" id="quotation_-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4 quotation-dependent">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="quotation_amount" id="quotation_amount"
                    placeholder="Quotation Amount">
                <label for="quotation_amount">Quotation Amount <span class="text-danger">*</span></label>
                <span class="text-danger" id="quotation_amount-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4 quotation-dependent">
            <div class="form-floating form-floating-outline">
                <input type="date" class="form-control" name="quotation_date" id="quotation_date"
                    placeholder="Quotation Date">
                <label for="quotation_date">Quotation Date <span class="text-danger">*</span></label>
                <span class="text-danger" id="quotation_date-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="quotation_by" id="quotation_by">
                </select>
                <label for="quotation_by">Entered By <span class="text-danger">*</span></label>
                <span class="text-danger" id="quotation_by-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="quotation_status" id="quotation_status">
                    <option value="Agreed">Agreed</option>
                    <option value="Pending">Pending</option>
                </select>
                <label for="quotation_status">Quotation Status <span class="text-danger">*</span></label>
                <span class="text-danger" id="quotation_status-error"></span>
            </div>
        </div>

        <!-- Channel Partner -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="channel_partner" id="channel_partner">
                    <option value="">Select Channel Partner</option>
                </select>
                <label for="channel_partner">Channel Partner <span class="text-danger">*</span></label>
                <span class="text-danger" id="channel_partner-error"></span>
            </div>
        </div>
    </div>

    <h5 class="fw-bold mb-3 mt-4">☀️ Solar Details</h5>
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="solar_type" id="solar_type">
                    <option value="">Solar Type</option>
                    <option value="Residential">Residential</option>
                    <option value="Commercial">Commercial</option>
                    <option value="Industrial">Industrial</option>
                    <option value="Other">Other</option>
                </select>
                <label for="solar_type">Solar Type <span class="text-danger">*</span></label>
                <span class="text-danger" id="solar_type-error"></span>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="roof_area" id="roof_area"
                    placeholder="Roof Area" />
                <label for="roof_area">Roof Top Area <span class="text-danger">*</span></label>
                <span class="text-danger" id="roof_area-error"></span>
            </div>
        </div>

        <!-- Solar Company -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="solar_company" id="solar_company">
                    <option value="">Select Solar Panel Company</option>
                    @foreach($solarCompanies as $company)
                        <option value="{{ $company->name }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                <label for="solar_company">Solar Panel Company Name <span class="text-danger">*</span></label>
                <span class="text-danger" id="solar_company-error"></span>
            </div>
        </div>
        <!-- Panel Type -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="panel_type" id="panel_type">
                    <option value="">Select Panel Type</option>
                    @foreach($panelTypes as $panelType)
                        <option value="{{ $panelType->name }}">{{ $panelType->name }}</option>
                    @endforeach
                </select>
                <label for="panel_type">Panel Type <span class="text-danger">*</span></label>
                <span class="text-danger" id="panel_type-error"></span>
            </div>
        </div>
        <!-- Number of Panels -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="number_of_panels" id="number_of_panels"
                    placeholder="Number of Panels" min="1" />
                <label for="number_of_panels">Number of Panels <span class="text-danger">*</span></label>
                <span class="text-danger" id="number_of_panels-error"></span>
            </div>
        </div>




        <!-- Panel Voltage -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="panel_voltage" id="panel_voltage"
                    placeholder="Panel Voltage" />
                <label for="panel_voltage">Panel Voltage <span class="text-danger">*</span></label>
                <span class="text-danger" id="panel_voltage-error"></span>
            </div>
        </div>

        <!-- Capacity -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="solar_capacity" id="solar_capacity"
                    placeholder="Solar Capacity" />
                <label for="solar_capacity">Solar Capacity (kW)</label>
                <span class="text-danger" id="solar_capacity-error"></span>
            </div>
        </div>

        <script>
            /**
             * This script renders solar_serial_number[] input boxes according to the number_of_panels value,
             * and automatically displays server validation errors (like .0, .1, etc) under the relevant input.
             *
             * Expects errors as a JS variable named window.serverValidationErrors (from the backend).
             * Example:
             * window.serverValidationErrors = {
             *     "solar_serial_number.0": ["The selected solar_serial_number.0 is invalid."],
             *     "solar_serial_number.1": ["The selected solar_serial_number.1 is invalid."]
             * };
             */
            $(document).ready(function() {
                // Optionally add this variable for demonstration; in reality, you would pass this from the backend.
                // window.serverValidationErrors = {!! json_encode($errors->getMessages()) !!};

                function renderSerialInputs() {
                    var count = parseInt($('#number_of_panels').val());
                    var $container = $('#solarSerialNumbersContainer');
                    var $heading = $('#solarSerialNumbersHeading');
                    $container.empty();

                    if (!isNaN(count) && count > 0) {
                        $heading.show();
                        $container.show();
                        for (var i = 1; i <= count; i++) {
                            var idx = i - 1;
                            var errorMsg = "";
                            // Check for validation errors from Laravel in window.serverValidationErrors
                            if (window.serverValidationErrors && window.serverValidationErrors['solar_serial_number.' + idx]) {
                                errorMsg = window.serverValidationErrors['solar_serial_number.' + idx][0];
                            }
                            var inputHtml = `
                                <div class="col-md-3 mb-2">
                                    <input type="text" class="form-control pl-4" name="solar_serial_number[]"
                                        id="solar_serial_number_${i}" placeholder="Solar Serial Number ${i}" />
                                    <span class="text-danger" id="solar_serial_number_${i}-error">${errorMsg}</span>
                                </div>
                            `;
                            $container.append(inputHtml);
                        }
                    } else {
                        $heading.hide();
                        $container.hide();
                    }
                }

                // Initial render if value already set (for edit forms)
                renderSerialInputs();
                $('#number_of_panels').on('input', function() {
                    renderSerialInputs();
                });

                // On page load: show general error (if exists) in a toast or above the panel area
                if (window.serverValidationMessage) {
                    // Example: You can use your preferred toast/alert component here.
                    // alert(window.serverValidationMessage);
                    // Or insert to a custom div
                    if ($('#solar_general_error').length === 0) {
                        $('<div class="alert alert-danger" id="solar_general_error"></div>').insertBefore('#solarSerialNumbersHeading');
                    }
                    $('#solar_general_error').text(window.serverValidationMessage).show();
                }
            });
        </script>
        <!-- Inverter Company -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="inverter_company" id="inverter_company">
                    <option value="">Select Inverter Company</option>
                    @foreach($inverterCompanies as $company)
                        <option value="{{ $company->name }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                <label for="inverter_company">Inverter Company <span class="text-danger">*</span></label>
                <span class="text-danger" id="inverter_company-error"></span>
            </div>
        </div>
        <!-- Inverter Capacity -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="inverter_capacity" id="inverter_capacity"
                    placeholder="Inverter Capacity" />
                <label for="inverter_capacity">Inverter Capacity <span class="text-danger">*</span></label>
                <span class="text-danger" id="inverter_capacity-error"></span>
            </div>
        </div>
        <!-- Inverter Serial Number -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="inverter_serial_number" id="inverter_serial_number"
                    placeholder="Inverter Serial Number" />
                <label for="inverter_serial_number">Inverter Serial Number <span class="text-danger">*</span></label>
                <span class="text-danger" id="inverter_serial_number-error"></span>
            </div>
        </div>
        <!-- Application Reference No -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="application_ref_no" id="application_ref_no"
                    placeholder="Application Reference No." />
                <label for="application_ref_no">Application Reference No. <span class="text-danger">*</span></label>
            </div>
        </div>
        <!-- Light Bill No -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="light_bill_no" id="light_bill_no"
                    placeholder="Consumer No." />
                <label for="light_bill_no">Light Bill No <span class="text-danger">*</span></label>
                <span class="text-danger" id="light_bill_no-error"></span>
            </div>
        </div>
        <!-- Payment Mode -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="payment_mode" id="payment_mode">
                    <option value="">Select Payment Mode</option>
                    <option value="cash">Cash</option>
                    <option value="loan">Loan</option>
                </select>
                <label for="payment_mode">Payment Mode <span class="text-danger">*</span></label>
                <span class="text-danger" id="payment_mode-error"></span>
            </div>
        </div>
        <!-- Solar Total Amount -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="solar_total_amount" id="solar_total_amount"
                    placeholder="Total Amount" />
                <label for="solar_total_amount">Solar Total Amount (₹) <span class="text-danger">*</span></label>
                <span class="text-danger" id="solar_total_amount-error"></span>
            </div>
        </div>
        <!-- Total Received Amount -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="total_received_amount" id="total_received_amount"
                    placeholder="Total Received Amount" />
                <label for="total_received_amount">Total Received Amount (₹) </label>
                <span class="text-danger" id="total_received_amount-error"></span>
            </div>
        </div>
        <!-- Date of Full Payment -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="date" class="form-control" name="date_full_payment" id="date_full_payment" />
                <label for="date_full_payment">Date of Full Payment </label>
                <span class="text-danger" id="date_full_payment-error"></span>
            </div>
        </div>
        <!-- Registration Date -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="date" class="form-control" name="registration_date" id="registration_date" />
                <label for="registration_date">Registration Date <span class="text-danger">*</span></label>
                <span class="text-danger" id="registration_date-error"></span>
            </div>
        </div>


    </div>

    <!-- Dynamic solar serial number inputs will be added here -->

    <h5 id="solarSerialNumbersHeading" class="fw-bold mb-3 mt-4" style="display:none;"># Solar Panel Serial Numbers</h5>
    <div class="row mb-4" id="solarSerialNumbersContainer">

    </div>


    <!-- Section: 💰 Subsidy Info -->
    <h5 class="fw-bold mb-3 mt-4">💰 Subsidy Info</h5>
    <div class="row">
        <!-- Subsidy Amount -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="subsidy_amount" id="subsidy_amount"
                    placeholder="Subsidy Amount" />
                <label for="subsidy_amount">Subsidy Amount (₹)</label>
            </div>
        </div>
        <!-- Subsidy Status -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="subsidy_status" id="subsidy_status">
                    <option value="">Select Subsidy Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Received">Received</option>
                </select>
                <label for="subsidy_status">Subsidy Status</label>
            </div>
        </div>
        <!-- Token ID No. -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="token_id" id="token_id"
                    placeholder="Token ID No." />
                <label for="token_id">Token ID No.</label>
            </div>
        </div>
    </div>
    <!-- Consumer Bank Details Section -->
    <div id="bankDetailsSection" class="mb-4">
        <h6 class="fw-bold mb-3">🏦 Customer Bank Details</h6>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="form-floating form-floating-outline">
                    <select class="form-select" name="bank_name" id="bank_name">
                        <option value="">Select Bank</option>
                    </select>
                    <label for="bank_name">Bank Name <span style="color:red">*</span></label>
                    <span class="text-danger" id="bank_name-error"></span>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="bank_branch" id="bank_branch"
                        placeholder="Branch">
                    <label for="bank_branch">Branch <span class="text-danger">*</span></label>
                    <span class="text-danger" id="bank_branch-error"></span>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="form-floating form-floating-outline">
                    <input type="number" class="form-control" name="account_number" id="account_number" maxlength="20"
                        placeholder="Account Number">
                    <label for="account_number">Account Number <span class="text-danger">*</span></label>
                    <span class="text-danger" id="account_number-error"></span>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"
                        placeholder="IFSC Code">
                    <label for="ifsc_code">IFSC Code <span class="text-danger">*</span></label>
                    <span class="text-danger" id="ifsc_code-error"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- Loan Bank Details Section -->
    <div id="loanBankDetailsSection" class="mb-4">
        {{-- Loan Applicant Bank Details --}}
        <div class="my-4" id="loanApplicantBankDetails">
            <h6 class="fw-bold mb-3">🏦 Loan Applicants Bank Details</h6>
            <!-- Copy Checkbox -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="sameAsConsumerBank">
                <label class="form-check-label" for="sameAsConsumerBank">
                    Same as Consumer Bank Details
                </label>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="loan_type" id="loan_type" required>
                            <option value="finance">Finance</option>
                            <option value="bank">Bank</option>
                        </select>
                        <label for="loan_type">Loan Type <span class="text-danger">*</span></label>
                        <span class="text-danger" id="loan_type-error"></span>
                    </div>
                </div>
                <!-- Jan-Samarth ID -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="jan_samarth_id" id="jan_samarth_id"
                            placeholder="Jan-Samarth ID" required />
                        <label for="jan_samarth_id">Jan-Samarth ID <span class="text-danger">*</span></label>
                        <span class="text-danger" id="jan_samarth_id-error"></span>
                    </div>
                </div>
                <!-- Jan-Samarth Registration Date -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="date" class="form-control" name="jan_samarth_registration_date"
                            id="jan_samarth_registration_date" placeholder="Registration Date" required />
                        <label for="jan_samarth_registration_date">Jan-Samarth Registration Date <span
                                class="text-danger">*</span></label>
                        <span class="text-danger" id="jan_samarth_registration_date-error"></span>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="bank_name_loan" id="bank_name_loan">
                            <option value="">Select Bank</option>
                            <!-- Dynamic options -->
                        </select>
                        <label for="bank_name_loan">Bank Name <span style="color:red">*</span></label>
                        <span class="text-danger" id="bank_name_loan-error"></span>
                    </div>
                </div>
                <!-- Branch -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="bank_branch_loan" id="bank_branch_loan"
                            placeholder="Branch">
                        <label for="bank_branch_loan">Branch <span class="text-danger">*</span></label>
                        <span class="text-danger" id="bank_branch_loan-error"></span>
                    </div>
                </div>
                <!-- Account Number -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="account_number_loan"
                            id="account_number_loan" placeholder="Account Number">
                        <label for="account_number_loan">Account Number <span class="text-danger">*</span></label>
                        <span class="text-danger" id="account_number_loan-error"></span>
                    </div>
                </div>
                <!-- IFSC Code -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="ifsc_code_loan" id="ifsc_code_loan"
                            placeholder="IFSC Code">
                        <label for="ifsc_code_loan">IFSC Code <span class="text-danger">*</span></label>
                        <span class="text-danger" id="ifsc_code_loan-error"></span>
                    </div>
                </div>
                <!-- Branch Manager Phone -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="branch_manager_phone_loan"
                            id="branch_manager_phone_loan" placeholder="Branch Manager Phone">
                        <label for="branch_manager_phone_loan">Branch Manager Phone <span
                                style="color:red">*</span></label>
                        <span class="text-danger" id="branch_manager_phone_loan-error"></span>
                    </div>
                </div>
                <!-- Loan Manager Phone -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="loan_manager_phone_loan"
                            id="loan_manager_phone_loan" placeholder="Loan Manager Phone">
                        <label for="loan_manager_phone_loan">Loan Manager Phone <span
                                style="color:red">*</span></label>
                        <span class="text-danger" id="loan_manager_phone_loan-error"></span>
                    </div>
                </div>
                <!-- Loan Status -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="loan_status" id="loan_status">
                            <option value="">Select Loan Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Sanctioned">Sanctioned</option>
                            <option value="Disbursed">Disbursed</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Approved">Approved</option>
                        </select>
                        <label for="loan_status">Loan Status <span class="text-danger">*</span></label>
                        <span class="text-danger" id="loan_status-error"></span>
                    </div>
                </div>
                <!-- Loan Sanction Date -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="date" class="form-control" name="loan_sanction_date"
                            id="loan_sanction_date" />
                        <label for="loan_sanction_date">Loan Sanction Date</label>
                        <span class="text-danger" id="loan_sanction_date-error"></span>
                    </div>
                </div>
                <!-- Loan Disbursal Date -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="date" class="form-control" name="loan_disbursed_date"
                            id="loan_disbursed_date" />
                        <label for="loan_disbursed_date">Loan Disbursal Date</label>
                        <span class="text-danger" id="loan_disbursed_date-error"></span>
                    </div>
                </div>
                <!-- Managed By -->
                {{-- <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="managed_by" id="managed_by">
                            <option value="">Select Accountant</option>
                            <!-- Example dynamic options -->
                        </select>
                        <label for="managed_by">Managed By <span class="text-danger">*</span></label>
                        <span class="text-danger" id="managed_by-error"></span>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="my-4 mx-4" id="coApplicantNeeded">
            <label class="form-label fw-medium mb-2 d-block">Do you want to Add Co Applicant Details <span class="text-danger">*</span></label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="add_coapplicant" id="add_coapplicant_yes" value="yes">
                <label class="form-check-label" for="add_coapplicant_yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="add_coapplicant" id="add_coapplicant_no" value="no">
                <label class="form-check-label" for="add_coapplicant_no">No</label>
            </div>
            <span class="text-danger" id="add_coapplicant-error"></span>
        </div>

        {{-- Co Applicant Bank Details --}}
        <div class="my-4" id="coApplicantBankDetails">
            <h6 class="fw-bold mb-3">🏦 Co Applicants Bank Details</h6>
            <!-- Copy Checkbox -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="coapplicant_sameAsConsumerBank">
                <label class="form-check-label" for="coapplicant_sameAsConsumerBank">
                    Same as Consumer Bank Details
                </label>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="coapplicant_loan_type" id="coapplicant_loan_type" required>
                            <option value="finance">Finance</option>
                            <option value="bank">Bank</option>
                        </select>
                        <label for="coapplicant_loan_type">Loan Type <span class="text-danger">*</span></label>
                        <span class="text-danger" id="coapplicant_loan_type-error"></span>
                    </div>
                </div>
                <!-- Jan-Samarth ID -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="coapplicant_jan_samarth_id" id="coapplicant_jan_samarth_id"
                            placeholder="Jan-Samarth ID" required />
                        <label for="coapplicant_jan_samarth_id">Jan-Samarth ID <span class="text-danger">*</span></label>
                        <span class="text-danger" id="coapplicant_jan_samarth_id-error"></span>
                    </div>
                </div>
                <!-- Jan-Samarth Registration Date -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="date" class="form-control" name="coapplicant_jan_samarth_registration_date"
                            id="coapplicant_jan_samarth_registration_date" placeholder="Registration Date" required />
                        <label for="coapplicant_jan_samarth_registration_date">Jan-Samarth Registration Date <span
                                class="text-danger">*</span></label>
                        <span class="text-danger" id="coapplicant_jan_samarth_registration_date-error"></span>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="coapplicant_bank_name_loan" id="coapplicant_bank_name_loan">
                            <option value="">Select Bank</option>
                            <!-- Dynamic options -->
                        </select>
                        <label for="coapplicant_bank_name_loan">Bank Name <span style="color:red">*</span></label>
                        <span class="text-danger" id="coapplicant_bank_name_loan-error"></span>
                    </div>
                </div>
                <!-- Branch -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="coapplicant_bank_branch_loan" id="coapplicant_bank_branch_loan"
                            placeholder="Branch">
                        <label for="coapplicant_bank_branch_loan">Branch <span class="text-danger">*</span></label>
                        <span class="text-danger" id="coapplicant_bank_branch_loan-error"></span>
                    </div>
                </div>
                <!-- Account Number -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="coapplicant_account_number_loan"
                            id="coapplicant_account_number_loan" placeholder="Account Number">
                        <label for="coapplicant_account_number_loan">Account Number <span class="text-danger">*</span></label>
                        <span class="text-danger" id="coapplicant_account_number_loan-error"></span>
                    </div>
                </div>
                <!-- IFSC Code -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="coapplicant_ifsc_code_loan" id="coapplicant_ifsc_code_loan"
                            placeholder="IFSC Code">
                        <label for="coapplicant_ifsc_code_loan">IFSC Code <span class="text-danger">*</span></label>
                        <span class="text-danger" id="coapplicant_ifsc_code_loan-error"></span>
                    </div>
                </div>
                <!-- Branch Manager Phone -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="coapplicant_branch_manager_phone_loan"
                            id="coapplicant_branch_manager_phone_loan" placeholder="Branch Manager Phone">
                        <label for="coapplicant_branch_manager_phone_loan">Branch Manager Phone <span
                                style="color:red">*</span></label>
                        <span class="text-danger" id="coapplicant_branch_manager_phone_loan-error"></span>
                    </div>
                </div>
                <!-- Loan Manager Phone -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="coapplicant_loan_manager_phone_loan"
                            id="coapplicant_loan_manager_phone_loan" placeholder="Loan Manager Phone">
                        <label for="coapplicant_loan_manager_phone_loan">Loan Manager Phone <span
                                style="color:red">*</span></label>
                        <span class="text-danger" id="coapplicant_loan_manager_phone_loan-error"></span>
                    </div>
                </div>
                <!-- Loan Status -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="coapplicant_loan_status" id="coapplicant_loan_status">
                            <option value="">Select Loan Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Sanctioned">Sanctioned</option>
                            <option value="Disbursed">Disbursed</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Approved">Approved</option>
                        </select>
                        <label for="coapplicant_loan_status">Loan Status <span class="text-danger">*</span></label>
                        <span class="text-danger" id="coapplicant_loan_status-error"></span>
                    </div>
                </div>
                <!-- Loan Sanction Date -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="date" class="form-control" name="coapplicant_loan_sanction_date"
                            id="coapplicant_loan_sanction_date" />
                        <label for="coapplicant_loan_sanction_date">Loan Sanction Date</label>
                        <span class="text-danger" id="coapplicant_loan_sanction_date-error"></span>
                    </div>
                </div>
                <!-- Loan Disbursal Date -->
                <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <input type="date" class="form-control" name="coapplicant_loan_disbursed_date"
                            id="coapplicant_loan_disbursed_date" />
                        <label for="coapplicant_loan_disbursed_date">Loan Disbursal Date</label>
                        <span class="text-danger" id="coapplicant_loan_disbursed_date-error"></span>
                    </div>
                </div>
                <!-- Managed By -->
                {{-- <div class="col-md-3 mb-4">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="coapplicant_managed_by" id="coapplicant_managed_by">
                            <option value="">Select Accountant</option>
                            <!-- Example dynamic options -->
                        </select>
                        <label for="coapplicant_managed_by">Managed By <span class="text-danger">*</span></label>
                        <span class="text-danger" id="coapplicant_managed_by-error"></span>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- INSTALLATION Details Section -->
    <h5 class="fw-bold mb-3 mt-4">🔧 Installation Details</h5>
    <div class="row">
        <!-- Installers -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="installers" id="installers">
                    <option value="">Select Installers</option>
                </select>
                <label for="installers">Installers</label>
                <span class="text-danger" id="installers-error"></span>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="installation_status" id="installation_status">
                    <option value="">Select Installation Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Installed">Installed</option>
                </select>
                <label for="installation_status">Installation Status <span class="text-danger">*</span></label>
                <span class="text-danger" id="installation_status-error"></span>
            </div>
        </div>
        <!-- Installation Date -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="date" class="form-control" name="installation_date" id="installation_date">
                <label for="installation_date">Installation Date</label>
                <span class="text-danger" id="installation_date-error"></span>
            </div>
        </div>
        <!-- Structure Department Name -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="structure_department_name"
                    id="structure_department_name" placeholder="Structure Department Name" />
                <label for="structure_department_name">Structure Department Name</label>
                <span class="text-danger" id="structure_department_name-error"></span>
            </div>
        </div>
        <!-- Wiring Department Name -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="wiring_department_name" id="wiring_department_name"
                    placeholder="Wiring Department Name" />
                <label for="wiring_department_name">Wiring Department Name</label>
                <span class="text-danger" id="wiring_department_name-error"></span>
            </div>
        </div>
        <!-- SR Number -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="sr_number" id="sr_number"
                    placeholder="SR Number" />
                <label for="sr_number">SR Number</label>
                <span class="text-danger" id="sr_number-error"></span>
            </div>
        </div>
        <!-- Meter Payment Receipt Number -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="meter_payment_receipt_number"
                    id="meter_payment_receipt_number" placeholder="Receipt Number" />
                <label for="meter_payment_receipt_number">Meter Payment Receipt No.</label>
                <span class="text-danger" id="meter_payment_receipt_number-error"></span>
            </div>
        </div>
        <!-- Meter Payment Date -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="date" class="form-control" name="meter_payment_date" id="meter_payment_date" />
                <label for="meter_payment_date">Meter Payment Date</label>
                <span class="text-danger" id="meter_payment_date-error"></span>
            </div>
        </div>
        <!-- Meter Payment Amount -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" step="0.01" class="form-control" name="meter_payment_amount"
                    id="meter_payment_amount" placeholder="Amount" />
                <label for="meter_payment_amount">Meter Payment Amount</label>
                <span class="text-danger" id="meter_payment_amount-error"></span>
            </div>
        </div>
        <!-- Panel Serial Numbers -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="panel_serial_numbers" id="panel_serial_numbers"
                    placeholder="Inverter Serial Number" />
                <label for="panel_serial_numbers">Panel Serial Numbers</label>
                <span class="text-danger" id="panel_serial_numbers-error"></span>
            </div>
        </div>
        <!-- DCR Certificate Number -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="dcr_certificate_number" id="dcr_certificate_number"
                    placeholder="DCR Certificate Number" />
                <label for="dcr_certificate_number">DCR Certificate Number</label>
                <span class="text-danger" id="dcr_certificate_number-error"></span>
            </div>
        </div>
    </div>
    <!-- Section: 📌 Application Status -->
    <h5 class="fw-bold mb-3 mt-4">📌 Application Status</h5>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_completed" id="is_completed" disabled>
                <label class="form-check-label" for="is_completed">Completed Fitting</label>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="offcanvas-footer justify-content-md-end position-absolute bottom-0 end-0 w-100">
        <button class="btn rounded btn-secondary me-2" type="button" data-bs-dismiss="offcanvas">
            <span class="tf-icons mdi mdi-cancel me-1"></span>Cancel
        </button>
        <button type="submit" class="btn rounded btn-primary waves-effect waves-light">
            <span class="tf-icons mdi mdi-checkbox-marked-circle-outline"></span>&nbsp;Submit
        </button>
    </div>
</form>
</form>

<script type="text/javascript">
    var clientId = $("#clientId").val();

    $(document).ready(function() {

        // Define function inside document ready
        function toggleDisableAmountAndDateFields() {
            var paymentMode = $('#payment_mode').val();
            var $totalReceivedAmount = $('#total_received_amount');
            var $dateFullPayment = $('#date_full_payment');

            if (paymentMode === 'cash') {
                console.log('Payment mode is cash');
                // Enable both fields
                $totalReceivedAmount.prop('disabled', false).css({
                    'background-color': '',
                    'cursor': ''
                });
                $dateFullPayment.prop('disabled', false).css({
                    'background-color': '',
                    'cursor': ''
                });
            } else {
                console.log('Payment mode is loan');
                // Disable both fields
                $totalReceivedAmount.prop('disabled', true).css({
                    'background-color': '#e9ecef',
                    'cursor': 'not-allowed'
                });
                $dateFullPayment.prop('disabled', true).css({
                    'background-color': '#e9ecef',
                    'cursor': 'not-allowed'
                });
            }
        }

        // ✅ Call once on page load
        toggleDisableAmountAndDateFields();

        // ✅ Call again whenever dropdown changes
        $('#payment_mode').on('change', function() {
            toggleDisableAmountAndDateFields();
        });

    }); // <-- end document.ready
</script>

<script type="text/javascript">
    var clientId = $("#clientId").val();
    $(document).ready(function() {

        if (clientId > 0) {
            $('#loanBankDetailsSection').show();
        }
        if (clientId == 0) {
            $('#loanBankDetailsSection').hide();
        }

        function toggleCoApplicantDiv() {
            var addCoapplicant = $("input[name='add_coapplicant']:checked").val();
            if (addCoapplicant === "yes") {
                $('#coApplicantBankDetails').slideDown();
            } else {
                $('#coApplicantBankDetails').slideUp();
            }
        }

        function toggleCompletedFittingCheckbox() {
                var status = $('#installation_status').val();
                if (!status || status === 'Pending') {
                    $('#is_completed').prop('disabled', true).prop('checked', false);
                } else {
                    $('#is_completed').prop('disabled', false);
                }
            }

        // Initial check on page load
        toggleCompletedFittingCheckbox();

        // Listen for changes to installation_status
        $('#installation_status').on('change', function() {
            toggleCompletedFittingCheckbox();
        });

        $('#payment_mode').change(function() {
            const selected = $(this).val();

            if (selected === 'loan') {
                $('#loanBankDetailsSection').slideDown();
                toggleCoApplicantDiv();
            } else {
                $('#loanBankDetailsSection').slideUp();
                $('#coApplicantBankDetails').slideUp(); // Also hide co-applicant section if not loan
            }
        });

        // Call once on page load
        toggleCoApplicantDiv();
        // Call on change of co-applicant radio buttons
        $("input[name='add_coapplicant']").on('change', function() {
            toggleCoApplicantDiv();
        });

        // $('#age').on('input', function() {
        //     console.log('age changed')
        //     toggleCoApplicantDiv();
        // });

        // Optionally, call toggleCoApplicantDiv on page load if needed:
        // toggleCoApplicantDiv();



        let url =
            `{{ config('apiConstants.PROFILE_URLS.PROFILE') }}?id={{ request()->get('id') }}&Params='Address'`;

        fnCallAjaxHttpGetEvent(url, null, true, true, function(response) {
            if (response.status === 200 && response.data) {
                // Store all states data globally
                allStates = response.data.state;

                // Use fixed country ID
                const fixedCountryId = 1;

                // Populate state dropdowns based on fixed country ID
                populateStateDropdown(fixedCountryId, "#PerAdd_state");
            }
        });

        function populateStateDropdown(countryId, stateDropdownSelector) {
            const stateDropdown = $(stateDropdownSelector);
            stateDropdown.empty(); // Clear existing options
            stateDropdown.append('<option value="">Select State</option>'); // Add default option
            if (countryId) {
                const filteredStates = allStates.filter(state => state.country_id == countryId);
                filteredStates.forEach(function(state) {
                    stateDropdown.append(`<option value="${state.name}">${state.name}</option>`);
                });
            }
        }

        function autoCalculateCapacity() {
            var numPanels = parseFloat($('#number_of_panels').val());
            var panelVoltage = parseFloat($('#panel_voltage').val());
            if (!isNaN(numPanels) && !isNaN(panelVoltage)) {
                var capacity = (numPanels * panelVoltage) / 1000;
                var formattedCapacity = capacity.toFixed(3);
                $('#solar_capacity').val(formattedCapacity);
            } else {
                $('#solar_capacity').val('');
            }
        }

        // Attach event listeners if the fields exist
        $(document).on('input', '#number_of_panels, #panel_voltage', function() {
            autoCalculateCapacity();
        });

        var bankDataMap = {};
        var bankDataMap2 = {};
        var bankDataMap3 = {};

        // Load banks via AJAX
        fnCallAjaxHttpGetEvent("{{ config('apiConstants.MANAGE_BANK_URLS.MANAGE_BANK') }}", null, true, true,
            function(response) {
                if (response.status === 200 && response.data) {
                    var $Dropdown = $("#bank_name");
                    var $Dropdown2 = $("#bank_name_loan");
                    var $Dropdown3 = $("#coapplicant_bank_name_loan");

                    $Dropdown.empty();
                    $Dropdown2.empty();
                    $Dropdown3.empty();
                    $Dropdown.append(new Option('Select Bank', ''));
                    $Dropdown2.append(new Option('Select Bank', ''));
                    $Dropdown3.append(new Option('Select Bank', ''));

                    // Save bank data by ID and populate all dropdowns
                    response.data.forEach(function(bank) {
                        bankDataMap[bank.id] = bank;
                        bankDataMap2[bank.id] = bank;
                        bankDataMap3[bank.id] = bank;
                        $Dropdown.append(new Option(bank.bank_name, bank.id));
                        $Dropdown2.append(new Option(bank.bank_name, bank.id));
                        $Dropdown3.append(new Option(bank.bank_name, bank.id));
                    });
                }
            });

        $("#bank_name").on("change", function() {
            var selectedBankId = $(this).val();
            if (selectedBankId && bankDataMap[selectedBankId]) {
                var bank = bankDataMap[selectedBankId];
                $("#bank_branch").val(bank.branch_name || '');
                $("#ifsc_code").val(bank.ifsc_code || '');
            } else {
                // Reset fields if nothing selected
                $("#bank_branch").val('');
                $("#ifsc_code").val('');
            }
        });

        $("#bank_name_loan").on("change", function() {
            var selectedBankId = $(this).val();
            if (selectedBankId && bankDataMap[selectedBankId]) {
                var bank = bankDataMap[selectedBankId];
                $("#bank_branch_loan").val(bank.branch_name || '');
                $("#ifsc_code_loan").val(bank.ifsc_code || '');
                $("#branch_manager_phone_loan").val(bank.branch_manager_phone || '');
                $("#loan_manager_phone_loan").val(bank.loan_manager_phone || '');
            } else {
                // Reset fields if nothing selected
                $("#bank_branch_loan").val('');
                $("#ifsc_code_loan").val('');
                $("#branch_manager_phone_loan").val('');
                $("#loan_manager_phone_loan").val('');
            }
        });

        // Load Channel Partner via AJAX
        fnCallAjaxHttpGetEvent("{{ config('apiConstants.CHANNEL_PARTNERS_URLS.CHANNEL_PARTNERS') }}", null,
            true, true,
            function(response) {
                if (response.status === 200 && response.data) {
                    var $Dropdown = $("#channel_partner");
                    $Dropdown.empty();
                    $Dropdown.append(new Option('Select Channel Partner', ''));

                    response.data.forEach(function(data) {
                        $Dropdown.append(new Option(data.legal_name, data.id));
                    });
                }
            });

        // Load Installers via AJAX
        fnCallAjaxHttpGetEvent("{{ config('apiConstants.INSTALLERS_URLS.INSTALLERS') }}", null, true, true,
            function(response) {
                if (response.status === 200 && response.data) {
                    // Populate existing installers dropdown
                    var $Dropdown = $("#installers");
                    $Dropdown.empty();
                    $Dropdown.append(new Option('Select Installers', ''));

                    // Populate new installer_id dropdown for installation details
                    var $InstallerIdDropdown = $("#installer_id");
                    $InstallerIdDropdown.empty();
                    $InstallerIdDropdown.append(new Option('Select Installer', ''));

                    response.data.forEach(function(data) {
                        $Dropdown.append(new Option(data.name, data.id));
                        $InstallerIdDropdown.append(new Option(data.name, data.id));
                    });
                }
            });

        fnCallAjaxHttpGetEvent("{{ config('apiConstants.QUOTATION_URLS.QUOTATION_ALL_ACCOUNTANT') }}", null,
            true, true,
            function(response) {
                if (response.status === 200 && response.data) {
                    var options = '<option selected disabled value="">Select</option>';
                    $.each(response.data, function(index, accountant) {
                        options += '<option value="' + accountant.id + '">' + accountant.full_name +
                            '</option>';
                    });
                    $("#quotation_by").html(options);
                    $("#managed_by").html(options);
                    $("#coapplicant_managed_by").html(options);

                } else {
                    console.log('Failed to retrieve accountant data.');
                }
            });

        if (clientId > 0) {
            var Url = "{{ config('apiConstants.QUOTATION_URLS.QUOTATION_VIEW') }}";
            fnCallAjaxHttpGetEvent(Url, {
                quotesId: clientId,
                is_customer: 1
            }, true, true, function(response) {
                if (response.status === 200 && response.data) {
                    setTimeout(() => {
                        $("#first_name").val(response.data.first_name);
                        $("#last_name").val(response.data.last_name);
                        $("#middle_name").val(response.data.middle_name);
                        $("#email").val(response.data.email);
                        $("#pan_number").val(response.data.pan_number);
                        $("#aadhar_number").val(response.data.aadhar_number);
                        $("#age").val(response.data.age);
                        $("#gender").val(response.data.gender);
                        $("#marital_status").val(response.data.marital_status);
                        $("#mobile").val(response.data.mobile);
                        $("#alternate_mobile").val(response.data.alternate_mobile);
                        $("#PerAdd_state").val(response.data.PerAdd_state);
                        $("#district").val(response.data.district);
                        $("#PerAdd_city").val(response.data.PerAdd_city);
                        $("#PerAdd_pin_code").val(response.data.PerAdd_pin_code);
                        $("#customer_address").val(response.data.customer_address);
                        $("#customer_residential_address").val(response.data.customer_residential_address);
                        $("#quotation_").val(response.data.required);
                        $("#solar_capacity").val(response.data.capacity);
                        $("#roof_area").val(response.data.roof_area);
                        $("#quotation_amount").val(response.data.amount);
                        $("#quotation_date").val(response.data.date);
                        $("#quotation_by").val(response.data.by);
                        $("#quotation_status").val(response.data.status);
                    }, 100);
                } else {
                    console.log('Failed to retrieve role data.');
                }
            });
        }

        if (clientId > 0) {
            var Url = "{{ config('apiConstants.CLIENT_URLS.CLIENT_VIEW') }}";
            fnCallAjaxHttpGetEvent(Url, {
                customerId: clientId
            }, true, true, function(response) {
                if (response.status === 200 && response.data) {
                    // Solar detail data
                    if (response.data.solar_detail) {
                        $("#solar_type").val(response.data.solar_detail.solar_type);
                        $("#inverter_capacity").val(response.data.solar_detail.inverter_capacity);
                        $("#inverter_serial_number").val(response.data.solar_detail
                            .inverter_serial_number);
                        $("#number_of_panels").val(response.data.solar_detail.number_of_panels);
                        $("#panel_type").val(response.data.solar_detail.panel_type);
                        $("#roof_type").val(response.data.solar_detail.panel_voltage);
                        $("#panel_voltage").val(response.data.solar_detail.panel_voltage);
                        $("#structure_department_name").val(response.data.solar_detail
                            .structure_department_name);
                        $("#wiring_department_name").val(response.data.solar_detail
                            .wiring_department_name);
                        $("#sr_number").val(response.data.solar_detail.sr_number);
                        $("#meter_payment_receipt_number").val(response.data.solar_detail
                            .meter_payment_receipt_number);
                        $("#meter_payment_date").val(response.data.solar_detail.meter_payment_date);
                        $("#meter_payment_amount").val(response.data.solar_detail.meter_payment_amount);
                        $("#panel_serial_numbers").val(response.data.solar_detail.panel_serial_numbers);
                        $("#dcr_certificate_number").val(response.data.solar_detail
                            .dcr_certificate_number);
                        $("#roof_type").val(response.data.solar_detail.roof_type);
                        $("#roof_area").val(response.data.solar_detail.roof_area);
                        $("#solar_capacity").val(response.data.solar_detail.capacity);
                        $("#solar_company").val(response.data.solar_detail.solar_company);
                        $("#inverter_company").val(response.data.solar_detail.inverter_company);
                        $("#installers").val(response.data.solar_detail.installers);
                        $("#installation_date").val(response.data.solar_detail.installation_date);
                        $("#installation_status").val(response.data.solar_detail.installation_status);
                        $("#jan_samarth_id").val(response.data.solar_detail.jan_samarth_id);
                        $("#payment_mode").val(response.data.solar_detail.payment_mode);
                        $("#application_ref_no").val(response.data.solar_detail.application_ref_no);
                        $("#channel_partner").val(response.data.solar_detail.channel_partner_id);
                        $("#registration_date").val(response.data.solar_detail.registration_date);
                        $("#solar_total_amount").val(response.data.solar_detail.solar_total_amount);
                        $("#light_bill_no").val(response.data.solar_detail.light_bill_no);
                        $("#total_received_amount").val(response.data.solar_detail
                            .total_received_amount);
                        $("#date_full_payment").val(response.data.solar_detail.date_full_payment);
                        $("#is_completed").prop("checked", response.data.solar_detail.is_completed);
                        $("#jan_samarth_registration_date").val(response.data.solar_detail
                            .jan_samarth_registration_date);

                        $("#coapplicant_loan_type").val(response.data.solar_detail.coapplicant_loan_type);
                        $("#coapplicant_jan_samarth_id").val(response.data.solar_detail.coapplicant_jan_samarth_id);
                        $("#coapplicant_jan_samarth_registration_date").val(response.data.solar_detail.coapplicant_jan_samarth_registration_date);
                        $("#coapplicant_bank_name_loan").val(response.data.solar_detail.coapplicant_bank_name_loan);
                        $("#coapplicant_bank_branch_loan").val(response.data.solar_detail.coapplicant_bank_branch_loan);
                        $("#coapplicant_account_number_loan").val(response.data.solar_detail.coapplicant_account_number_loan);
                        $("#coapplicant_ifsc_code_loan").val(response.data.solar_detail.coapplicant_ifsc_code_loan);
                        $("#coapplicant_branch_manager_phone_loan").val(response.data.solar_detail.coapplicant_branch_manager_phone_loan);
                        $("#coapplicant_loan_manager_phone_loan").val(response.data.solar_detail.coapplicant_loan_manager_phone_loan);
                        $("#coapplicant_loan_status").val(response.data.solar_detail.coapplicant_loan_status);
                        $("#coapplicant_loan_sanction_date").val(response.data.solar_detail.coapplicant_loan_sanction_date);
                        $("#coapplicant_loan_disbursed_date").val(response.data.solar_detail.coapplicant_loan_disbursed_date);
                        $("#coapplicant_managed_by").val(response.data.solar_detail.coapplicant_managed_by);
                    }

                    // Subsidy data
                    if (response.data.subsidy) {
                        $("#token_id").val(response.data.subsidy.token_id);
                        $("#subsidy_amount").val(response.data.subsidy.subsidy_amount);
                        $("#subsidy_status").val(response.data.subsidy.subsidy_status);
                    }

                    // Customer bank detail data
                    if (response.data.customer_bank_detail) {
                        $("#bank_name").val(response.data.customer_bank_detail.bank_name);
                        $("#bank_branch").val(response.data.customer_bank_detail.bank_branch);
                        $("#account_number").val(response.data.customer_bank_detail.account_number);
                        $("#ifsc_code").val(response.data.customer_bank_detail.ifsc_code);
                    }

                    // Loan bank detail data
                    if (response.data.loan_bank_detail) {
                        $("#loan_type").val(response.data.loan_bank_detail.loan_type);
                        $("#bank_name_loan").val(response.data.loan_bank_detail.bank_name);
                        $("#bank_branch_loan").val(response.data.loan_bank_detail.bank_branch);
                        $("#account_number_loan").val(response.data.loan_bank_detail.account_number);
                        $("#ifsc_code_loan").val(response.data.loan_bank_detail.ifsc_code);
                        $("#branch_manager_phone_loan").val(response.data.loan_bank_detail
                            .branch_manager_phone);
                        $("#loan_manager_phone_loan").val(response.data.loan_bank_detail
                            .loan_manager_phone);
                        $("#loan_status").val(response.data.loan_bank_detail.loan_status);
                        $("#loan_status").val(response.data.loan_bank_detail.loan_status);
                        $("#managed_by").val(response.data.loan_bank_detail.managed_by);
                        $("#loan_sanction_date").val(response.data.loan_bank_detail.loan_sanction_date);
                        $("#loan_disbursed_date").val(response.data.loan_bank_detail
                            .loan_disbursed_date);
                    }
                } else {
                    console.log('Failed to retrieve client data.');
                }
            });
        }
    });

    // jQuery Validation Setup
    $("#customerForm").validate({
        rules: {
            first_name: {
                required: true,
                maxlength: 50,
            },
            last_name: {
                required: true,
                maxlength: 50,
            },
            email: {
                required: true,
            },
            aadhar_number: {
                required: true,
            },
            pan_number: {
                required: true,
            },
            age: {
                required: true,
                digits: true,
                minlength: 1,
                maxlength: 3
            },
            gender: {
                required: true
            },
            marital_status: {
                required: true
            },
            alternate_mobile: {
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            PerAdd_state: {
                required: true,
            },
            district: {
                required: true,
            },
            PerAdd_city: {
                required: true,
            },
            PerAdd_pin_code: {
                required: true,
            },
            roof_type: {
                required: true
            },
            roof_area: {
                required: true,
                number: true
            },
            solar_capacity: {
                required: true
            },
            solar_company: {
                required: true
            },
            inverter_company: {
                required: true
            },
            customer_address: {
                required: true
            },
            customer_residential_address: {
                required: true
            },
            channel_partner: {
                required: true
            },
            registration_date: {
                required: true,
                dateISO: true
            },
            solar_total_amount: {
                required: true,
                number: true
            },
            installers: {
                required: false
            },
            jan_samarth_id: {
                required: true
            },
            payment_mode: {
                required: true
            },
            bank_name: {
                required: true
            },
            bank_branch: {
                required: true
            },
            account_number: {
                required: true,
                digits: true
            },
            ifsc_code: {
                required: true,
                minlength: 11,
                maxlength: 11
            },
            total_received_amount: {
                number: true
            },
            application_ref_no: {
                required: true
            },
            // managed_by: {
            //     required: true
            // },
            solar_type: {
                required: true
            },
            panel_type: {
                required: true
            },
            number_of_panels: {
                required: true
            },
            panel_voltage: {
                required: true
            },
            inverter_capacity: {
                required: true
            },
            inverter_serial_number: {
                required: true
            },
            quotation_amount: {
                required: true,
            },
            quotation_by: {
                required: true
            },
            quotation_date: {
                required: true
            },
            light_bill_no: {
                required: true
            },
        },
        messages: {
            first_name: {
                required: "First Name is required",
                maxlength: "Name cannot be more than 50 characters",
            },
            last_name: {
                required: "Last Name is required",
                maxlength: "Name cannot be more than 50 characters",
            },
            aadhar_number: {
                required: "Aadhar Number is required",
            },
            pan_number: {
                required: "Pan Number is required",
            },
            age: {
                required: "Age is required",
                digits: "Please enter a valid age",
                minlength: "Age must be at least 1 year old",
                maxlength: "Age cannot exceed 3 digits"
            },
            gender: {
                required: "Gender is required."
            },
            marital_status: {
                required: "Marital status is required."
            },
            alternate_mobile: {
                digits: "Please enter a valid mobile number",
                minlength: "Mobile number must be at least 10 digits long",
                maxlength: "Mobile number must be at most 15 digits long"
            },
            mobile: {
                required: "Mobile is required",
                digits: "Please enter a valid mobile number",
                minlength: "Mobile number must be at least 10 digits long",
                maxlength: "Mobile number must be at most 15 digits long"
            },
            PerAdd_state: {
                required: "State is required",
            },
            district: {
                required: "District is required",
            },
            PerAdd_city: {
                required: "City is required",
            },
            PerAdd_pin_code: {
                required: "PinCode is required",
            },
            roof_area: {
                required: "Roof area is required.",
                number: "Please enter a valid number."
            },
            solar_capacity: {
                required: "Solar capacity is required."
            },
            solar_company: {
                required: "Solar company name is required."
            },
            inverter_company: {
                required: "Inverter company name is required."
            },
            customer_address: {
                required: "Customer address is required."
            },
            channel_partner: {
                required: "Channel partner selection is required."
            },
            registration_date: {
                required: "Registration date is required.",
                dateISO: "Please enter a valid date."
            },
            solar_total_amount: {
                required: "Total amount is required.",
                number: "Please enter a valid number."
            },
            bank_name: {
                required: "Bank name is required."
            },
            bank_branch: {
                required: "Bank branch is required."
            },
            account_number: {
                required: "Account number is required.",
                digits: "Please enter only digits."
            },
            ifsc_code: {
                required: "IFSC code is required.",
                minlength: "IFSC code must be 11 characters long.",
                maxlength: "IFSC code must be 11 characters long."
            },
            customer_residential_address: {
                required: "Residential address is required."
            },
            jan_samarth_id: {
                required: "Jan-Samarth ID is required."
            },
            payment_mode: {
                required: "Payment mode is required."
            },
            installers: {
                required: "Installers selection is required."
            },
            total_received_amount: {
                number: "Please enter a valid number."
            },
            application_ref_no: {
                required: "Application reference number is required."
            },
            // managed_by: {
            //     required: "Managed by is required."
            // },
            solar_type: {
                required: "Solar Type is required."
            },
            panel_type: {
                required: "Panel Type is required."
            },
            number_of_panels: {
                required: "Number of panels is required."
            },
            panel_voltage: {
                required: "Panel Voltage is required."
            },
            inverter_capacity: {
                required: "Inverter Capacity is required."
            },
            inverter_serial_number: {
                required: "Inverter Serial Number is required."
            },
        },
        errorPlacement: function(error, element) {
            var errorId = element.attr("name") + "-error";
            $("#" + errorId).text(error.text());
            $("#" + errorId).show();
            element.addClass("is-invalid");
        },
        success: function(label, element) {
            var errorId = $(element).attr("name") + "-error";
            $("#" + errorId).text("");
            $(element).removeClass("is-invalid");
        },
        submitHandler: function(form) {
            event.preventDefault();

            var formData = new FormData(form);
            formData.append('is_completed', $("#is_completed").is(":checked") ? 1 : 0);

            var storeUrl = "{{ config('apiConstants.CLIENT_URLS.CLIENT_STORE') }}";
            var updateUrl = "{{ config('apiConstants.CLIENT_URLS.CLIENT_UPDATE') }}";
            var url = clientId > 0 ? updateUrl : storeUrl;
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    Authorization: "Bearer " + getCookie("access_token"),
                },

                success: function(response) {
                    if (response.status === 200) {
                        bootstrap.Offcanvas.getInstance(document.getElementById('commonOffcanvas')).hide();
                        $('#grid').DataTable().ajax.reload();
                        ShowMsg("bg-success", response.message);
                    } else {
                        ShowMsg("bg-warning", 'The record could not be processed.');
                    }
                },
                error: function(xhr) {
                  console.log(xhr.responseJSON.errors);
                  console.log(xhr.responseJSON.errors.inverter_serial_number);
                  console.log(xhr.responseJSON.errors.number_of_panels);
                  $("#inverter_serial_number-error").text(xhr.responseJSON.errors.inverter_serial_number);
                  $("#number_of_panels-error").text(xhr.responseJSON.errors.number_of_panels);
                  // Handle solar_serial_number.* validation errors
                  if (xhr.responseJSON && xhr.responseJSON.errors) {
                      Object.keys(xhr.responseJSON.errors).forEach(function(key) {
                          if (key.startsWith("solar_serial_number.")) {
                              // The key is like "solar_serial_number.0"
                              // Get the index
                              var idx = parseInt(key.split('.')[1]) + 1; // +1 because IDs are 1-based
                              var errorMsg = xhr.responseJSON.errors[key][0];
                              var errorSpanId = "#solar_serial_number_" + idx + "-error";
                              $(errorSpanId).text(errorMsg);
                              $(errorSpanId).show();
                              // Add is-invalid class to the input
                              $("#solar_serial_number_" + idx).addClass("is-invalid");
                          }
                      });
                  }

                  $("#inverter_serial_number").addClass("is-invalid");
                  $("#number_of_panels").addClass("is-invalid");
                },
                complete: function() {
                    // Optionally hide loader here
                }
            });
        }
    });
</script>
<script>
    document.getElementById("sameAsPermanent").addEventListener("change", function() {
        let permanent = document.getElementById("customer_address");
        let residential = document.getElementById("customer_residential_address");

        if (this.checked) {
            residential.value = permanent.value; // copy
            residential.setAttribute("readonly", true); // lock field
        } else {
            residential.value = ""; // clear
            residential.removeAttribute("readonly");
        }
    });

    // Optional: Auto-update if user changes permanent address while checked
    document.getElementById("customer_address").addEventListener("input", function() {
        let checkbox = document.getElementById("sameAsPermanent");
        let residential = document.getElementById("customer_residential_address");
        if (checkbox.checked) {
            residential.value = this.value;
        }
    });
</script>
<script>
    document.getElementById("sameAsConsumerBank").addEventListener("change", function() {
        let bankName = document.getElementById("bank_name");
        let branch = document.getElementById("bank_branch");
        let accNo = document.getElementById("account_number");
        let ifsc = document.getElementById("ifsc_code");

        let loanBankName = document.getElementById("bank_name_loan");
        let loanBranch = document.getElementById("bank_branch_loan");
        let loanAccNo = document.getElementById("account_number_loan");
        let loanIfsc = document.getElementById("ifsc_code_loan");

        if (this.checked) {
            loanBankName.value = bankName.value;
            loanBranch.value = branch.value;
            loanAccNo.value = accNo.value;
            loanIfsc.value = ifsc.value;

            // Make read-only
        } else {
            // Clear values & re-enable
            loanBankName.value = "";
            loanBranch.value = "";
            loanAccNo.value = "";
            loanIfsc.value = "";
        }
    });

    // Auto update loan fields if consumer bank fields change while checked
    ["bank_name", "bank_branch", "account_number", "ifsc_code"].forEach(id => {
        document.getElementById(id).addEventListener("input", function() {
            if (document.getElementById("sameAsConsumerBank").checked) {
                document.getElementById(id + "_loan").value = this.value;
            }
        });
    });
</script>
