<style>
    #commonOffcanvas.offcanvas {
        width: 900px !important;
        max-width: 100vw;
    }

    @media (max-width: 991.98px) {
        #commonOffcanvas.offcanvas {
            width: 100vw !important;
        }
    }
</style>

<form action="{{ isset($stockPurchase) ? route('stock-purchase.update', $stockPurchase->id) : route('stock-purchase.store') }}" id="stockPurchaseForm" name="stockPurchaseForm" class="form-horizontal" method="POST"
    enctype="multipart/form-data">
    @csrf
    @if(isset($stockPurchase))
        @method('PUT')
        <input type="hidden" name="id" value="{{ $stockPurchase->id }}">
    @endif

    <div class="row">
        <!-- Supplier Name -->
        <div class="col-md-4 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="supplier_name" id="supplier_name"
                    value="{{ old('supplier_name', isset($stockPurchase) ? $stockPurchase->supplier_name : '') }}"
                    placeholder="Supplier Name" />
                <label for="supplier_name">Supplier Name <span class="text-danger">*</span></label>
                <span class="text-danger" id="supplier_name-error"></span>
            </div>
        </div>
        <!-- Purchase Invoice No. -->
        <div class="col-md-4 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="purchase_invoice_no" id="purchase_invoice_no"
                    value="{{ old('purchase_invoice_no', isset($stockPurchase) ? $stockPurchase->purchase_invoice_no : '') }}"
                    placeholder="Purchase Invoice No." />
                <label for="purchase_invoice_no">Purchase Invoice No. <span class="text-danger">*</span></label>
                <span class="text-danger" id="purchase_invoice_no-error"></span>
            </div>
        </div>
        <!-- Purchase Invoice Date -->
        <div class="col-md-4 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="date" class="form-control" name="invoice_date" id="invoice_date"
                    value="{{ old('invoice_date', isset($stockPurchase) ? $stockPurchase->invoice_date : '') }}"
                    placeholder="Invoice Date" />
                <label for="invoice_date">Invoice Date <span class="text-danger">*</span></label>
                <span class="text-danger" id="invoice_date-error"></span>
            </div>
        </div>
        <!-- Product Category -->
        <div class="col-md-4 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="product_category_id" id="product_category_id">
                    <option value="">Select Product Category</option>
                    @foreach ($productCategories as $productCategory)
                        <option value="{{ $productCategory->id }}"
                            {{ old('product_category_id', isset($stockPurchase) ? $stockPurchase->product_category_id : '') == $productCategory->id ? 'selected' : '' }}>
                            {{ $productCategory->name }}
                        </option>
                    @endforeach
                </select>
                <label for="product_category_id">Product Category <span class="text-danger">*</span></label>
                <span class="text-danger" id="product_category-error"></span>
            </div>
        </div>
        <!-- Brand -->
        <div class="col-md-4 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="brand" id="brand"
                    value="{{ old('brand', isset($stockPurchase) ? $stockPurchase->brand : '') }}"
                    placeholder="Brand" />
                <label for="brand">Brand <span class="text-danger">*</span></label>
                <span class="text-danger" id="brand-error"></span>
            </div>
        </div>
        <!-- Model -->
        <div class="col-md-4 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="model" id="model"
                    value="{{ old('model', isset($stockPurchase) ? $stockPurchase->model : '') }}"
                    placeholder="Model" />
                <label for="model">Model <span class="text-danger">*</span></label>
                <span class="text-danger" id="model-error"></span>
            </div>
        </div>
        <!-- Capacity -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" name="capacity" id="capacity"
                    value="{{ old('capacity', isset($stockPurchase) ? $stockPurchase->capacity : '') }}"
                    placeholder="Capacity" />
                <label for="capacity">Capacity <span class="text-danger">*</span></label>
                <span class="text-danger" id="capacity-error"></span>
            </div>
        </div>
        <!-- Quantity -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="quantity" id="quantity"
                    value="{{ old('quantity', isset($stockPurchase) ? $stockPurchase->quantity : '') }}"
                    placeholder="Quantity" min="1" max="100" />
                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                <span class="text-danger" id="quantity-error"></span>
            </div>
        </div>
        <!-- Purchase Price -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" name="purchase_price" id="purchase_price"
                    value="{{ old('purchase_price', isset($stockPurchase) ? $stockPurchase->purchase_price : '') }}"
                    placeholder="Purchase Price" min="0" step="0.01" />
                <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
                <span class="text-danger" id="purchase_price-error"></span>
            </div>
        </div>
        <!-- GST -->
        <div class="col-md-3 mb-4">
            <div class="form-floating form-floating-outline">
                <select class="form-select" name="gst" id="gst" aria-label="GST (%)">
                    <option value="" disabled {{ old('gst', isset($stockPurchase) ? $stockPurchase->gst : '') == '' ? 'selected' : '' }}>Select GST (%)</option>
                    <option value="12" {{ old('gst', isset($stockPurchase) ? $stockPurchase->gst : '') == '12' ? 'selected' : '' }}>12%</option>
                    <option value="18" {{ old('gst', isset($stockPurchase) ? $stockPurchase->gst : '') == '18' ? 'selected' : '' }}>18%</option>
                    <option value="28" {{ old('gst', isset($stockPurchase) ? $stockPurchase->gst : '') == '28' ? 'selected' : '' }}>28%</option>
                </select>
                <label for="gst">GST (%) <span class="text-danger">*</span></label>
                <span class="text-danger" id="gst-error"></span>
            </div>
        </div>
        <!-- Upload Supplier Invoice Copy -->
        <div class="col-md-12 mb-4">
            <label class="form-label">Upload Supplier Invoice Copy (Allowed file types: PDF, JPG, JPEG, PNG)</label>
            <div>
                <button type="button" id="custom-upload-btn" class="btn btn-outline-primary d-flex align-items-center">
                    <i class="mdi mdi-upload me-2"></i>
                    <span>
                        @if(isset($stockPurchase) && !empty($stockPurchase->supplier_invoice_copy_path))
                            Update Supplier Invoice Copy
                        @else
                            Upload Supplier Invoice Copy
                        @endif
                    </span>
                </button>
                <input type="file" name="invoice_copy" id="invoice_copy" accept="application/pdf,image/jpeg,image/png" style="display: none;">
                <span class="text-danger ms-2" id="invoice_copy-error"></span>
            </div>
            <div class="" id="uploaded-file-info">
                @if(isset($stockPurchase) && !empty($stockPurchase->supplier_invoice_copy_path))
                    <span class="text-success" title="File uploaded">
                        <i class="mdi mdi-file-check-outline" style="font-size: 1.5rem;"></i>
                        <span id="uploaded-file-name">{{ basename($stockPurchase->supplier_invoice_copy_path) }}</span>
                    </span>
                @else
                    <span id="uploaded-file-name" class="text-secondary"></span>
                @endif
            </div>
        </div>
        <script>
            $(function() {
                $('#custom-upload-btn').on('click', function() {
                    $('#invoice_copy').trigger('click');
                });

                $('#invoice_copy').on('change', function(e) {
                    let file = e.target.files[0];
                    if (file) {
                        $('#uploaded-file-name').text(file.name).removeClass('text-secondary').addClass('text-success');
                    } else {
                        $('#uploaded-file-name').text('').removeClass('text-success').addClass('text-secondary');
                    }
                });
            });
        </script>

        <div class="col-md-12 mb-4" id="serial-numbers-container" style="display:none;">
            <label class="form-label">Enter Serial Numbers</label>
            <div id="serial-numbers-inputs" class="row g-2"></div>
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

<script>
    $(document).ready(function() {
        $("#stockPurchaseForm").validate({
            rules: {
                supplier_name: {
                    required: true,
                    maxlength: 100
                },
                purchase_invoice_no: {
                    required: true,
                    maxlength: 50
                },
                invoice_date: {
                    required: true,
                    date: true
                },
                product_category: {
                    required: true
                },
                brand: {
                    required: true,
                    maxlength: 50
                },
                model: {
                    required: true,
                    maxlength: 50
                },
                capacity: {
                    required: true,
                    maxlength: 50
                },
                quantity: {
                    required: true,
                    number: true,
                    min: 1,
                },
                purchase_price: {
                    required: true,
                    number: true,
                    min: 0
                },
                gst: {
                    required: true,
                    number: true,
                    min: 0
                },
                invoice_copy: {
                    extension: "pdf|jpg|jpeg|png"
                }
            },
            messages: {
                supplier_name: {
                    required: "Supplier Name is required",
                    maxlength: "Supplier Name cannot exceed 100 characters"
                },
                purchase_invoice_no: {
                    required: "Invoice No. is required",
                    maxlength: "Invoice No. cannot exceed 50 characters"
                },
                invoice_date: {
                    required: "Invoice Date is required",
                    date: "Please enter a valid date"
                },
                product_category: {
                    required: "Product Category is required"
                },
                brand: {
                    required: "Brand is required",
                    maxlength: "Brand cannot exceed 50 characters"
                },
                model: {
                    required: "Model is required",
                    maxlength: "Model cannot exceed 50 characters"
                },
                capacity: {
                    required: "Capacity is required",
                    maxlength: "Capacity cannot exceed 50 characters"
                },
                quantity: {
                    required: "Quantity is required",
                    number: "Please enter a valid quantity",
                    min: "Quantity must be at least 1"
                },
                purchase_price: {
                    required: "Purchase Price is required",
                    number: "Please enter a valid price",
                    min: "Purchase Price cannot be negative"
                },
                gst: {
                    required: "GST is required",
                    number: "Please enter a valid GST percentage",
                    min: "GST cannot be negative"
                },
                invoice_copy: {
                    extension: "Allowed file types: pdf, jpg, jpeg, png"
                }
            },
            errorPlacement: function(error, element) {
                var errorId = element.attr("name").replace(/\[|\]/g, "_") + "-error";
                // make sure error span exists, or append dynamically
                if (!$("#" + errorId).length) {
                    element.after('<span class="text-danger" id="' + errorId + '"></span>');
                }
                $("#" + errorId).text(error.text()).show();
                element.addClass("is-invalid");
            },
            success: function(label, element) {
                var errorId = $(element).attr("name").replace(/\[|\]/g, "_") + "-error";
                $("#" + errorId).text("").hide();
                $(element).removeClass("is-invalid");
            }
        });
    });

    $(document).ready(function() {
        $('#quantity').on('input', function() {
            var qty = parseInt($(this).val());
            var $container = $('#serial-numbers-container');
            var $inputs = $('#serial-numbers-inputs');
            $inputs.empty();

            if (qty > 0) {
                $container.show();
                for (var i = 1; i <= qty; i++) {
                    var inputId = `serial_number_${i}`;
                    $inputs.append(
                        `<div class="col-12 col-md-4 mb-2">
                                    <input type="text" class="form-control" name="serial_numbers[]" id="${inputId}" placeholder="Serial Number ${i}" required>
                                </div>`
                    );
                }
            } else {
                $container.hide();
            }
        });
    });
</script>
