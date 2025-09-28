<form action="{{ isset($product) ? route('stock-purchase-products-update', ['stockPurchase' => $stockPurchaseId, 'product' => (int) $product->id]) : route('stock-purchase-products-store', ['stockPurchase' => $stockPurchaseId]) }}" method="POST" id="productForm" class="form-horizontal">
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
            @error('serial_number') {{ $message }} @enderror
        </span>
    </div>

    <div id="additional-serial-numbers"></div>
    <button type="button" class="btn btn-outline-primary mb-3" id="addMoreSerial">
        <span class="tf-icons mdi mdi-plus"></span> Add More
    </button>



    <div class="offcanvas-footer justify-content-md-end position-absolute bottom-0 end-0 w-100">
        <button class="btn rounded btn-secondary me-2" type="button" data-bs-dismiss="offcanvas">
            <span class="tf-icons mdi mdi-cancel me-1"></span>Cancel
        </button>
        <button type="submit" class="btn rounded btn-primary waves-effect waves-light">
            <span class="tf-icons mdi mdi-checkbox-marked-circle-outline">&nbsp;</span>Submit
        </button>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $("#productForm").validate({
            rules: {
                serial_number: {
                    required: true,
                    maxlength: 100
                }
            },
            messages: {
                serial_number: {
                    required: "Product serial number is required",
                    maxlength: "Product serial number cannot be more than 100 characters"
                }
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
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        let serialIndex = 0;

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

        // Extend validation for dynamically added fields
        $("#productForm").validate({
            ignore: [],
            rules: {
                serial_number: {
                    required: true,
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
                var name = element.attr("name");
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
