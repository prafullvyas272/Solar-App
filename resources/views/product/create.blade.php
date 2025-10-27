<form action="{{ isset($product) ? route('stock-purchase-products-update', ['stockPurchase' => $stockPurchaseId, 'product' => (int) $product->id]) : route('stock-purchase-products-store', ['stockPurchase' => $stockPurchaseId]) }}" method="POST" id="productForm" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @if(isset($product))
        @method('PUT')
        <input type="hidden" name="id" value="{{ $product->id }}">
    @endif

    <!-- Product Serial Number -->
    <div class="form-floating form-floating-outline mb-4">
        <input
            type="text"
            class="form-control"
            name="serial_number"
            id="serial_number"
            placeholder="Product Serial Number"
            value="{{ old('serial_number', isset($product) ? $product->serial_number : '') }}"
            required
            minlength="8"
            maxlength="20"
        />
        <label for="serial_number">Product Serial Number <span style="color:red">*</span></label>
        <span class="text-danger" id="serial_number-error">
            {{-- Error will be injected here --}}
        </span>
    </div>

    <div id="additional-serial-numbers"></div>

    @if (!isset($product))
        <button type="button" class="btn btn-outline-primary mb-3" id="addMoreSerial">
            <span class="tf-icons mdi mdi-plus"></span> Add More
        </button>


        <div class="mb-4">
            <label for="csv_file" class="form-label">Upload CSV File (optional)</label>
            <input
                type="file"
                class="form-control"
                name="csv_file"
                id="csv_file"
            />
            <span class="text-danger" id="csv_file-error">
                {{-- Error will be injected here --}}
            </span>
        </div>
    @endif



    <div class="offcanvas-footer justify-content-md-end position-absolute bottom-0 end-0 w-100">
        <button class="btn rounded btn-secondary me-2" type="button" data-bs-dismiss="offcanvas">
            <span class="tf-icons mdi mdi-cancel me-1"></span>Cancel
        </button>
        <button type="submit" class="btn rounded btn-primary waves-effect waves-light" id="submitBtn">
            <span class="tf-icons mdi mdi-checkbox-marked-circle-outline">&nbsp;</span>Submit
        </button>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        let serialIndex = 0;

        // Add more serial number fields
        $('#addMoreSerial').on('click', function() {
            serialIndex++;
            let html = `
                <div class="form-floating form-floating-outline mb-4 serial-number-group" id="serial-group-${serialIndex}">
                    <input
                        type="text"
                        class="form-control"
                        name="serial_number_multi[]"
                        id="serial_number_multi_${serialIndex}"
                        placeholder="Product Serial Number"
                        required
                        minlength="8"
                        maxlength="20"
                    />
                    <label for="serial_number_multi_${serialIndex}">Product Serial Number <span style="color:red">*</span></label>
                    <span class="text-danger" id="serial_number_multi_${serialIndex}-error"></span>
                    <button type="button" class="remove-serial-btn" data-id="${serialIndex}" title="Remove">
                        <i class="mdi mdi-close-circle"></i>
                    </button>
                </div>
            `;
            $('#additional-serial-numbers').append(html);
        });

        // Remove serial number input
        $(document).on('click', '.remove-serial-btn', function() {
            let id = $(this).data('id');
            $('#serial-group-' + id).remove();
        });

        // Disable default form submission and use AJAX
        $('#productForm').on('submit', function(e) {
            e.preventDefault();

            // Clear previous errors
            $('.text-danger').text('');
            $('.form-control').removeClass('is-invalid');

            let form = $(this)[0];
            let formData = new FormData(form);

            // Disable submit button to prevent double submit
            $('#submitBtn').prop('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).find('input[name="_method"]').val() === 'PUT' ? 'POST' : 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(response) {
                    // You can customize this as needed, e.g. close modal, show success, reload table, etc.
                    window.location.href = response.redirect || window.location.href;
                },
                error: function(xhr) {
                    $('#submitBtn').prop('disabled', false);
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        // Loop through errors and show them in the correct fields
                        $.each(errors, function(field, messages) {
                            if (field === 'serial_number') {
                                $('#serial_number-error').text(messages[0]);
                                $('#serial_number').addClass('is-invalid');
                            } else if (field.startsWith('serial_number_multi')) {
                                // Find the correct input by index
                                let matches = field.match(/serial_number_multi\.(\d+)/);
                                if (matches) {
                                    let idx = matches[1];
                                    let inputId = 'serial_number_multi_' + idx;
                                    $('#' + inputId + '-error').text(messages[0]);
                                    $('#' + inputId).addClass('is-invalid');
                                } else {
                                    // fallback for array errors
                                    $('input[name="serial_number_multi[]"]').each(function(i, el) {
                                        if (errors['serial_number_multi.'+i]) {
                                            let inputId = $(el).attr('id');
                                            $('#' + inputId + '-error').text(errors['serial_number_multi.'+i][0]);
                                            $(el).addClass('is-invalid');
                                        }
                                    });
                                }
                            } else if (field === 'csv_file') {
                                $('#csv_file-error').text(messages[0]);
                                $('#csv_file').addClass('is-invalid');
                            } else {
                                // For any other field, try to show error by id
                                $('#' + field + '-error').text(messages[0]);
                                $('#' + field).addClass('is-invalid');
                            }
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        // Show general error
                        alert(xhr.responseJSON.message);
                    } else {
                        alert('An unexpected error occurred.');
                    }
                }
            });
        });

        // Client-side validation (optional, for instant feedback)
        $("#productForm").validate({
            ignore: [],
            rules: {
                serial_number: {
                    required: function(element) {
                        return $('#csv_file').val() === "";
                    },
                    minlength: 8,
                    maxlength: 20
                },
                'serial_number_multi[]': {
                    required: true,
                    minlength: 8,
                    maxlength: 20
                }
            },
            messages: {
                serial_number: {
                    required: "Product serial number is required",
                    minlength: "Product serial number must be at least 8 characters",
                    maxlength: "Product serial number cannot be more than 20 characters"
                },
                'serial_number_multi[]': {
                    required: "Product serial number is required",
                    minlength: "Product serial number must be at least 8 characters",
                    maxlength: "Product serial number cannot be more than 20 characters"
                }
            },
            errorPlacement: function(error, element) {
                var errorId = element.attr("id") + "-error";
                $("#" + errorId).text(error.text());
                $("#" + errorId).show();
                element.addClass("is-invalid");
            },
            success: function(label, element) {
                var errorId = $(element).attr("id") + "-error";
                $("#" + errorId).text("");
                $(element).removeClass("is-invalid");
            }
        });
    });
</script>

<style>
    .remove-serial-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #dc3545;
        background: none;
        border: none;
        font-size: 1.3rem;
        cursor: pointer;
    }
    .serial-number-group {
        position: relative;
    }
</style>
