<form action="javascript:void(0)" id="customerForm" name="customerForm" class="form-horizontal" method="POST"
    enctype="multipart/form-data">
    <input type="hidden" id="quotesId" name="quotesId" value="{{ $quotesId ?? '' }}">

    <!-- Section 1: Customer Basic Details -->
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
        <!-- Age -->
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
                <input type="number" class="form-control" name="aadhar_number" id="aadhar_number" maxlength="12" minlength="12"
                    placeholder="Aadhar Number" />
                <label for="aadhar_number">Aadhar Number <span class="text-danger">*</span></label>
                <span class="text-danger" id="aadhar_number-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" id="marital_status" name="marital_status">
                    <option value="">Select Marital Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                </select>
                <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                <span class="text-danger" id="marital_status-error"></span>
            </div>
        </div>
        <!-- Mobile -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="tel" class="form-control" name="mobile" id="mobile" maxlength="10"
                    placeholder="Aadhar-linked Mobile" />
                <label for="mobile">Aadhar-linked Mobile <span class="text-danger">*</span></label>
                <span class="text-danger" id="mobile-error"></span>
            </div>
        </div>
        <!-- Alternate Mobile -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="tel" class="form-control" name="alternate_mobile" id="alternate_mobile"
                    maxlength="10" placeholder="Alternate Mobile" />
                <label for="alternate_mobile">Alternate Mobile</label>
                <span class="text-danger" id="alternate_mobile-error"></span>
                <span class="text-danger" id="mobile-same-error" style="display:none;"></span>
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
                <input class="form-control" type="number" id="PerAdd_pin_code" name="PerAdd_pin_code" maxlength="8"
                    placeholder="Pin Code" />
                <label for="pin_code">Pin Code <span style="color:red">*</span></label>
                <span class="text-danger" id="PerAdd_pin_code-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <textarea class="form-control" name="customer_address" id="customer_address" placeholder="Enter Address"
                    style="height: 10px;"></textarea>
                <label for="customer_address">Permanent Address <span class="text-danger">*</span></label>
                <span class="text-danger" id="customer_address-error"></span>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <textarea class="form-control" name="customer_residential_address" id="customer_residential_address"
                    placeholder="Enter Address" style="height: 10px;"></textarea>
                <label for="customer_residential_address">Residential Address <span
                        class="text-danger">*</span></label>
                <span class="text-danger" id="customer_residential_address-error"></span>
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
    <!-- Section 3: Quotation -->
    <h5 class="fw-bold mb-3 mt-4">🧾 Quotation</h5>
    <div class="row">
        <!-- Quotation -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="quotation_" id="quotation_">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                <label for="quotation_">Is Quotation <span class="text-danger">*</span></label>
                <span class="text-danger" id="quotation_-error"></span>
            </div>
        </div>
        <!-- Proposed Solar Capacity -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="solar_capacity" id="solar_capacity"
                    placeholder="Solar Capacity" />
                <label for="solar_capacity">Solar Capacity (e.g., 3kW) <span class="text-danger">*</span></label>
                <span class="text-danger" id="solar_capacity-error"></span>
            </div>
        </div>
        <!-- Rooftop Size -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="rooftop_size" id="rooftop_size"
                    placeholder="Rooftop Size" />
                <label for="rooftop_size">Rooftop Size (in sq. ft) <span class="text-danger">*</span></label>
                <span class="text-danger" id="rooftop_size-error"></span>
            </div>
        </div>
        <!-- Quotation Amount -->
        <div class="col-md-3 mb-4 quotation-dependent">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="quotation_amount" id="quotation_amount"
                    placeholder="Quotation Amount">
                <label for="quotation_amount">Quotation Amount <span class="text-danger">*</span></label>
                <span class="text-danger" id="quotation_amount-error"></span>
            </div>
        </div>
        <!-- Quotation Date -->
        <div class="col-md-3 mb-4 quotation-dependent">
            <div class="form-floating form-floating-outline">
                <input type="date" class="form-control" name="quotation_date" id="quotation_date"
                    placeholder="Quotation Date">
                <label for="quotation_date">Quotation Date <span class="text-danger">*</span></label>
                <span class="text-danger" id="quotation_date-error"></span>
            </div>
        </div>

        <!-- Entered By -->
        {{-- <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="quotation_by" id="quotation_by">
                </select>
                <label for="quotation_by">Entered By <span class="text-danger">*</span></label>
                <span class="text-danger" id="quotation_by-error"></span>
            </div>
        </div> --}}
    </div>
    <div class="row quotation-dependent">
        <!-- Quotation Status -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="quotation_status" id="quotation_status">
                    <option value="Agreed">Agreed</option>
                    <option value="Pending">Pending</option>
                    <option value="Rejected">Rejected</option>
                </select>
                <label for="quotation_status">Quotation Status <span class="text-danger">*</span></label>
                <span class="text-danger" id="quotation_status-error"></span>
            </div>
        </div>
    </div>


    <div class="row quotation-dependent">
        <h4 class="fw-bold mb-3 mt-4">Items</h5>
        <div class="col-12">
            <div id="items-container">
                <div class="row g-2 align-items-end item-row" data-index="0">
                    <input type="hidden" class="form-control" name="items[0][item_id]">

                    <div class="col-12 col-md-3 mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="items[0][item_name]" placeholder="Item Name" required>
                            <label>Item Name</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="items[0][hsn]" placeholder="HSN" required>
                            <label>HSN</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="number" class="form-control" name="items[0][rate]" placeholder="Rate" min="0" step="0.01" required>
                            <label>Rate</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="number" class="form-control" name="items[0][quantity]" placeholder="Quantity" min="1" step="1" required>
                            <label>Quantity</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <div class="form-floating form-floating-outline">
                            <select class="form-select" name="items[0][tax]" required>
                                <option value="">Select Tax</option>
                                <option value="12">12 %</option>
                                <option value="18">18 %</option>
                                <option value="28">28 %</option>
                            </select>
                            <label>Tax</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-1 mb-2 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-success add-item-row me-1" title="Add Item">
                            <i class="mdi mdi-plus"></i>
                        </button>
                        <!-- Minus icon hidden for first row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @media (max-width: 767.98px) {
            #items-container .item-row > div {
                margin-bottom: 0.5rem;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            function getItemRowHtml(index) {
                return `
                <div class="row g-2 align-items-end item-row" data-index="${index}">
                    <input type="hidden" class="form-control" name="items[${index}][item_id]">

                    <div class="col-12 col-md-3 mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="items[${index}][item_name]" placeholder="Item Name" required>
                            <label>Item Name</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="items[${index}][hsn]" placeholder="HSN" required>
                            <label>HSN</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="number" class="form-control" name="items[${index}][rate]" placeholder="Rate" min="0" step="0.01" required>
                            <label>Rate</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="number" class="form-control" name="items[${index}][quantity]" placeholder="Quantity" min="1" step="1" required>
                            <label>Quantity</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <div class="form-floating form-floating-outline">
                            <select class="form-select" name="items[${index}][tax]" required>
                                <option value="">Select Tax</option>
                                <option value="12">12 %</option>
                                <option value="18">18 %</option>
                                <option value="28">28 %</option>
                            </select>
                            <label>Tax</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-1 mb-2 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-success add-item-row me-1" title="Add Item">
                            <i class="mdi mdi-plus"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger remove-item-row" title="Remove Item">
                            <i class="mdi mdi-minus"></i>
                        </button>
                    </div>
                </div>
                `;
            }

            // Add new item row
            $('#items-container').on('click', '.add-item-row', function() {
                var $container = $('#items-container');
                var lastIndex = 0;
                $container.find('.item-row').each(function() {
                    var idx = parseInt($(this).attr('data-index'));
                    if (idx > lastIndex) lastIndex = idx;
                });
                var newIndex = lastIndex + 1;
                $container.append(getItemRowHtml(newIndex));
                updateRemoveButtons();
            });

            // Remove item row
            $('#items-container').on('click', '.remove-item-row', function() {
                $(this).closest('.item-row').remove();
                updateRemoveButtons();
            });

            // Only show minus icon if more than one row
            function updateRemoveButtons() {
                var $rows = $('#items-container .item-row');
                $rows.each(function(i, row) {
                    var $minus = $(row).find('.remove-item-row');
                    if ($rows.length === 1) {
                        $minus.hide();
                    } else {
                        $minus.show();
                    }
                });
            }

            // Initial state
            updateRemoveButtons();
        });
    </script>
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

<script type="text/javascript">
    var quotesId = $("#quotesId").val();

    $(document).ready(function() {

        let url =
            `{{ config('apiConstants.PROFILE_URLS.PROFILE') }}?id={{ request()->get('id') }}&Params='Address'`;

        fnCallAjaxHttpGetEvent(url, null, true, true, function(response) {
            if (response.status === 200 && response.data) {
                allStates = response.data.state;
                const fixedCountryId = 1;
                populateStateDropdown(fixedCountryId, "#PerAdd_state");
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

        function populateStateDropdown(countryId, stateDropdownSelector) {
            const stateDropdown = $(stateDropdownSelector);
            stateDropdown.empty();
            stateDropdown.append('<option value="">Select State</option>');
            if (countryId) {
                const filteredStates = allStates.filter(state => state.country_id == countryId);
                filteredStates.forEach(function(state) {
                    stateDropdown.append(`<option value="${state.name}">${state.name}</option>`);
                });
            }
        }

        fnCallAjaxHttpGetEvent("{{ config('apiConstants.QUOTATION_URLS.QUOTATION_ALL_ACCOUNTANT') }}", null,
            true, true,
            function(
                response) {
                if (response.status === 200 && response.data) {
                    var options = '<option selected disabled value="">Select</option>';
                    $.each(response.data, function(index, accountant) {
                        options += '<option value="' + accountant.id + '">' + accountant.full_name +
                            '</option>';
                    });
                    $("#quotation_by").html(options);
                } else {
                    console.log('Failed to retrieve accountant data.');

                }
            });

        if (quotesId > 0) {
            var Url = "{{ config('apiConstants.QUOTATION_URLS.QUOTATION_VIEW') }}";
            fnCallAjaxHttpGetEvent(Url, {
                quotesId: quotesId
            }, true, true, function(
                response) {
                    console.log(response.data)
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
                    $("#rooftop_size").val(response.data.roof_area);
                    $("#quotation_amount").val(response.data.amount);
                    $("#quotation_date").val(response.data.date);
                    $("#quotation_by").val(response.data.by);
                    $("#quotation_status").val(response.data.status);
                    $("#channel_partner").val(response.data.channel_partner_id);
                    console.log(response.data.quotation_items);

                   // Populate items in the form if editing (quotesId > 0)
                   if (Array.isArray(response.data.quotation_items) && response.data.quotation_items.length > 0) {
                        // Remove all item rows except the first one
                        $('#items-container .item-row').not(':first').remove();

                        // Fill the first row
                        var firstItem = response.data.quotation_items[0];
                        var $firstRow = $('#items-container .item-row').first();
                        $firstRow.find('input[name^="items[0][item_id]"]').val(firstItem.id);
                        $firstRow.find('input[name^="items[0][item_name]"]').val(firstItem.item_name);
                        $firstRow.find('input[name^="items[0][item_name]"]').val(firstItem.item_name);
                        $firstRow.find('input[name^="items[0][hsn]"]').val(firstItem.hsn);
                        $firstRow.find('input[name^="items[0][rate]"]').val(firstItem.rate);
                        $firstRow.find('input[name^="items[0][quantity]"]').val(firstItem.quantity);
                        $firstRow.find('select[name^="items[0][tax]"]').val(parseInt(firstItem.tax));

                        // For the rest, add new rows and fill
                        for (var i = 1; i < response.data.quotation_items.length; i++) {
                            var item = response.data.quotation_items[i];
                            // Trigger add row button
                            $('.add-item-row').last().trigger('click');
                            var $row = $('#items-container .item-row').last();
                            $row.find('input[name^="items['+i+'][item_id]"]').val(item.id);
                            $row.find('input[name^="items['+i+'][item_name]"]').val(item.item_name);
                            $row.find('input[name^="items['+i+'][hsn]"]').val(item.hsn);
                            $row.find('input[name^="items['+i+'][rate]"]').val(item.rate);
                            $row.find('input[name^="items['+i+'][quantity]"]').val(item.quantity);
                            $row.find('select[name^="items['+i+'][tax]"]').val(parseInt(item.tax));
                        }
                   }


                   }, 100);




                } else {
                    console.log('Failed to retrieve role data.');
                }
            });
        }


    });

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
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            alternate_mobile: {
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            aadhar_number: {
                required: true,
            },
            pan_number: {
                required: true,
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
            customer_address: {
                required: true,
            },
            customer_residential_address: {
                required: true,
            },
            quotation_: {
                required: true,
            },
            solar_capacity: {
                required: true,
            },
            rooftop_size: {
                required: true,
            },
            quotation_amount: {
                required: true,
                number: true
            },
            quotation_date: {
                required: true,
            },
            quotation_by: {
                required: true,
            },
            quotation_status: {
                required: true,
            },
            channel_partner: {
                required: true,
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
            email: {
                required: "Email is required",
            },
            age: {
                required: "Age is required",
                digits: "Please enter a valid age",
                minlength: "Age must be at least 1 year old",
                maxlength: "Age cannot exceed 3 digits",
            },
            gender: {
                required: "Gender is required."
            },
            marital_status: {
                required: "Marital status is required."
            },
            mobile: {
                required: "Mobile is required",
                digits: "Please enter a valid mobile number",
                minlength: "Mobile number must be at least 10 digits long",
                maxlength: "Mobile number must be at most 15 digits long"
            },
            alternate_mobile: {
                digits: "Please enter a valid mobile number",
                minlength: "Mobile number must be at least 10 digits long",
                maxlength: "Mobile number must be at most 15 digits long"
            },
            aadhar_number: {
                required: "Aadhar Number is required",
            },
            pan_number: {
                required: "Pan Number is required",
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
                required: "Pin Code is required",
            },
            customer_address: {
                required: "Permanent Address is required",
            },
            customer_residential_address: {
                required: "Residential Address is required",
            },
            quotation_: {
                required: "Quotation selection is required",
            },
            solar_capacity: {
                required: "Solar Capacity is required",
            },
            rooftop_size: {
                required: "Rooftop Size is required",
            },
            quotation_amount: {
                required: "Quotation amount is required",
                number: "Please enter a valid number"
            },
            quotation_date: {
                required: "Quotation Date is required",
            },
            quotation_by: {
                required: "Quotation By is required",
            },
            quotation_status: {
                required: "Quotation Status is required",
            },
            channel_partner: {
                required: 'Channel Partner is required',
            },
        },
        errorPlacement: function(error, element) {
            var errorId = element.attr("name") + "-error";
            $("#" + errorId).text(error.text()).show();
            element.addClass("is-invalid");
        },
        success: function(label, element) {
            var errorId = $(element).attr("name") + "-error";
            $("#" + errorId).text("").hide();
            $(element).removeClass("is-invalid");
        },
        submitHandler: function(form, event) {
            event.preventDefault();

            var formData = new FormData(form);

            var storeUrl = "{{ config('apiConstants.QUOTATION_URLS.QUOTATION_STORE') }}";
            var updateUrl = "{{ config('apiConstants.QUOTATION_URLS.QUOTATION_UPDATE') }}";
            var url = quotesId > 0 ? updateUrl : storeUrl;

            fnCallAjaxHttpPostEventWithoutJSON(url, formData, true, true, function(response) {
                if (response.status === 200) {
                    bootstrap.Offcanvas.getInstance(document.getElementById('commonOffcanvas'))
                        .hide();
                    $('#grid').DataTable().ajax.reload();
                    ShowMsg("bg-success", response.message);
                } else {
                    ShowMsg("bg-warning", 'The record could not be processed.');
                    bootstrap.Offcanvas.getInstance(document.getElementById('commonOffcanvas'))
                    .hide();
                }
            });
        }
    });
</script>
<script>
    // Custom validation: mobile and alternate_mobile should not be the same
    // Define the custom validator before document ready to avoid undefined error
    if (typeof $.validator !== "undefined" && typeof $.validator.addMethod === "function") {
        $.validator.addMethod("notEqualToMobile", function(value, element) {
            var mobile = $("#mobile").val();
            // Only check if both fields have values
            if (value && mobile) {
                return value !== mobile;
            }
            return true;
        }, "Mobile and Alternate Mobile should not be the same.");
    }

    $(document).ready(function() {

        // Attach validation rule if form validation is initialized here
        if ($("#customerForm").length && $("#customerForm").validate) {
            $("#alternate_mobile").rules("add", {
                notEqualToMobile: true
            });
        }

        // Real-time check for both fields
        $("#mobile, #alternate_mobile").on("input", function() {
            var mobile = $("#mobile").val();
            var alternate = $("#alternate_mobile").val();
            if (mobile && alternate && mobile === alternate) {
                $("#mobile-same-error").text("Mobile and Alternate Mobile should not be the same.").show();
                $("#alternate_mobile").addClass("is-invalid");
            } else {
                $("#mobile-same-error").text("").hide();
                $("#alternate_mobile").removeClass("is-invalid");
            }
        });


        $('#alternate_mobile').on('input', function() {
                    var value = $(this).val();
                    var errorSpan = $('#alternate_mobile-error');
                    if (value.length > 0 && value.length < 10) {
                        errorSpan.text('Mobile number must be at least 10 digits long');
                    } else {
                        errorSpan.text('');
                    }
                });
    });
</script>
