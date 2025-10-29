<form action="{{ isset($dailyExpense) ? route('daily-expense.update', $dailyExpense->id) : route('daily-expense.store') }}"
      method="POST" id="dailyExpenseForm" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @if(isset($dailyExpense))
        @method('PUT')
        <input type="hidden" name="id" value="{{ $dailyExpense->id }}">
    @endif

    <!-- Date -->
    <div class="form-floating form-floating-outline mb-4">
        <input type="date" class="form-control" name="date" id="date" placeholder="Date"
            value="{{ old('date', isset($dailyExpense) ? \Carbon\Carbon::parse($dailyExpense->date)->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d')) }}"
            required/>
        <label for="date">Date <span style="color:red">*</span></label>
        <span class="text-danger" id="date-error">
            @error('date') {{ $message }} @enderror
        </span>
    </div>

    <!-- Category -->
    <div class="form-floating form-floating-outline mb-4">
        <select class="form-select" name="expense_category_id" id="expense_category_id" required>
            <option value="">Select Category</option>
            @if(isset($expenseCategories) && count($expenseCategories))
                @foreach($expenseCategories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('expense_category_id', isset($dailyExpense) ? $dailyExpense->expense_category_id : '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            @endif
        </select>
        <label for="expense_category_id">Category <span style="color:red">*</span></label>
        <span class="text-danger" id="expense_category_id-error">
            @error('expense_category_id') {{ $message }} @enderror
        </span>
    </div>

    <!-- Description -->
    <div class="form-floating form-floating-outline mb-4">
        <textarea class="form-control" name="description" id="description" placeholder="Description" style="height: 70px;">{{ old('description', isset($dailyExpense) ? $dailyExpense->description : '') }}</textarea>
        <label for="description">Description</label>
        <span class="text-danger" id="description-error">
            @error('description') {{ $message }} @enderror
        </span>
    </div>

    <!-- Amount -->
    <div class="form-floating form-floating-outline mb-4">
        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount"
            value="{{ old('amount', isset($dailyExpense) ? $dailyExpense->amount : '') }}"
            required step="0.01" min="0"/>
        <label for="amount">Amount (Rs. ) <span style="color:red">*</span></label>
        <span class="text-danger" id="amount-error">
            @error('amount') {{ $message }} @enderror
        </span>
    </div>

    <!-- Payment Mode -->
    <div class="form-floating form-floating-outline mb-4">
        <select class="form-select" name="payment_mode" id="payment_mode" required>
            <option value="">Select Payment Mode</option>
            @if(isset($paymentTypes) && count($paymentTypes))
                @foreach($paymentTypes as $modeValue => $modeLabel)
                    <option value="{{ $modeValue }}"
                        {{ old('payment_mode', isset($dailyExpense) ? $dailyExpense->payment_mode : '') == $modeValue ? 'selected' : '' }}>
                        {{ $modeLabel }}
                    </option>
                @endforeach
            @endif
        </select>
        <label for="payment_mode">Payment Mode <span style="color:red">*</span></label>
        <span class="text-danger" id="payment_mode-error">
            @error('payment_mode') {{ $message }} @enderror
        </span>
    </div>

    <!-- Paid By (Employee Dropdown) -->
    <div class="form-floating form-floating-outline mb-4">
        <input type="text" class="form-control" name="paid_by" id="paid_by"
            placeholder="Paid By"
            value="{{ old('paid_by', isset($dailyExpense) ? $dailyExpense->paid_by : '') }}"
            required>
        <label for="paid_by">Paid By <span style="color:red">*</span></label>
        <span class="text-danger" id="paid_by-error">
            @error('paid_by') {{ $message }} @enderror
        </span>
    </div>

    <!-- Upload Receipt -->
    <div class="mb-4">
        <label for="receipt_path" class="form-label">Upload Receipt</label>
        <input class="form-control" type="file" id="receipt_path" name="receipt_path" accept="image/*,application/pdf">
        <span class="text-danger" id="receipt_path-error">
            @error('receipt_path') {{ $message }} @enderror
        </span>
        @if(isset($dailyExpense) && !empty($dailyExpense->receipt_path))
            <div class="mt-2">
                <span>Existing Receipt: </span>
                <a href="{{ asset('storage/' . $dailyExpense->receipt_path) }}" target="_blank">View Receipt</a>
            </div>
        @endif
    </div>

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
        $("#dailyExpenseForm").validate({
            rules: {
                date: {
                    required: true,
                    date: true
                },
                expense_category_id: {
                    required: true
                },
                amount: {
                    required: true,
                    number: true,
                    min: 0.01
                },
                payment_mode: {
                    required: true
                },
                paid_by: {
                    required: true
                },
                receipt_path: {
                    extension: "jpg|jpeg|png|gif|pdf"
                }
            },
            messages: {
                date: {
                    required: "Date is required"
                },
                expense_category_id: {
                    required: "Category is required"
                },
                amount: {
                    required: "Amount is required",
                    number: "Amount must be a number",
                    min: "Amount must be greater than zero"
                },
                payment_mode: {
                    required: "Please select a payment mode"
                },
                paid_by: {
                    required: "Please select an employee"
                },
                receipt_path: {
                    extension: "Allowed file types: jpg, jpeg, png, gif, pdf"
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
