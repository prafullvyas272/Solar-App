@extends('layouts.layout')
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div class="head-label text-center mb-2 mb-sm-0">
                    <h5 class="card-title mb-0"><b>Transactions</b></h5>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ url('expense-reports') }}" class="btn btn-outline-info me-3">
                        <span class="tf-icons mdi mdi-chart-bar">&nbsp;</span>Ledger View
                    </a>
                    <button id="btnAddExpense" type="button" class="btn btn-primary waves-effect waves-light"
                        onClick="fnAddEdit(this, '{{ url('daily-expense/create') }}', 0, 'Add Transaction')">
                        <span class="tf-icons mdi mdi-plus">&nbsp;</span>Add Transaction
                    </button>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="p-3 border-top">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="filterExactDate" class="form-label">Filter by Date</label>
                        <input type="date" id="filterExactDate" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label for="filterMonthYear" class="form-label">Filter by Month / Year</label>
                        <input type="month" id="filterMonthYear" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label for="filterCategory" class="form-label">Filter by Category</label>
                        <select id="filterCategory" class="form-select">
                            <option value="">All Categories</option>
                            @foreach ($expenseCategories as $cat)
                                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="filterTransactionType" class="form-label">Filter by Transaction Type</label>
                        <select id="filterTransactionType" class="form-select">
                            <option value="">All Types</option>
                            @foreach ($transactionTypes as $type)
                                <option value="{{ $type->value }}">{{ $type->value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="filterPaymentMode" class="form-label">Filter by Payment Mode</label>
                        <select id="filterPaymentMode" class="form-select">
                            <option value="">All Payment Modes</option>
                            @foreach ($paymentTypes as $modeValue => $modeLabel)
                                <option value="{{ $modeLabel }}">{{ $modeLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="filterFromDate" class="form-label">From Date</label>
                        <input type="date" id="filterFromDate" class="form-control" />
                    </div>

                    <div class="col-md-3">
                        <label for="filterToDate" class="form-label">To Date</label>
                        <input type="date" id="filterToDate" class="form-control" />
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button id="btnApplyFilters" class="btn btn-primary me-2">
                            <span class="mdi mdi-filter">&nbsp;</span>Apply Filters
                        </button>
                        <button id="btnResetFilters" class="btn btn-secondary me-2">
                            <span class="mdi mdi-refresh">&nbsp;</span>Reset
                        </button>
                        <button id="btnExportExcel" class="btn btn-success">
                            <span class="mdi mdi-file-excel">&nbsp;</span>Export Excel
                        </button>
                    </div>
                </div>
            </div>

            <hr class="my-0">
            <div class="card-datatable text-nowrap">
                <table id="dailyExpenseGrid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Date</th>
                            <th>Transaction Type</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Amount (Rs. )</th>
                            <th>Payment Mode</th>
                            <th>Paid By</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dailyExpenses as $expense)
                            <tr>
                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <button type="button" class="btn btn-sm btn-primary waves-effect waves-light"
                                                onClick="fnAddEdit(this, '{{ url('daily-expense/' . $expense->id . '/edit') }}', {{ $expense->id }}, 'Edit Daily Expense')">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                        </li>
                                        <li class="list-inline-item">
                                            <form action="{{ route('daily-expense.destroy', $expense->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this expense?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </li>
                                        <li class="list-inline-item">
                                            @if (!empty($expense->receipt_path))
                                                <a href="{{ asset('storage/' . $expense->receipt_path) }}" download
                                                    class="btn btn-sm btn-success">
                                                    <i class="mdi mdi-download" title="Download Receipt"></i>
                                                </a>
                                            @else
                                                <span style="cursor: not-allowed"
                                                    class="btn btn-sm btn-outline-secondary disabled cursor-not-allowed"
                                                    aria-disabled="true" title="No Receipt Available"
                                                    style="pointer-events: none; opacity: 0.55;">
                                                    <i class="mdi mdi-download" title="Download Receipt"></i>
                                                </span>
                                            @endif
                                        </li>
                                    </ul>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($expense->date)->format('d-m-Y') }}</td>
                                <td>
                                    @if ($expense->transaction_type === 'expense')
                                        <span class="badge bg-primary">{{ $expense->transaction_type }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $expense->transaction_type }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $expenseCategories->where('id', $expense->expense_category_id)->pluck('name')->first() ?? '-' }}
                                </td>
                                <td>{{ $expense->description ?? '-' }}</td>
                                <td>{{ number_format($expense->amount, 2) }}</td>
                                <td>{{ App\Enums\PaymentMode::getModes()[$expense->payment_mode] ?? '-' }}</td>
                                <td>
                                    {{ $expense->paid_by }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($expense->created_at)->format('d-m-Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTable + Filter Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize DataTable with Buttons extension for Excel export
            var table = $('#dailyExpenseGrid').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<span class="mdi mdi-file-excel"></span> Export to Excel',
                        className: 'btn btn-success d-none',
                        title: 'Daily Expenses Report',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8] // Exclude Action column (0)
                        }
                    }
                ],
                'language': {
                    "loadingRecords": "&nbsp;",
                    "processing": "<img src='{{ asset('assets/img/illustrations/loader.gif') }}' alt='loader' />"
                },
                order: [
                    [1, "desc"]
                ],
            });

            // Custom method to apply date range filter on DataTable (convert dates to d-m-Y)
            function applyDateRangeFilter() {
                var fromDate = $('#filterFromDate').val();
                var toDate = $('#filterToDate').val();
                // Convert from yyyy-mm-dd to dd-mm-yyyy if values exist
                if (fromDate) {
                    var fromParts = fromDate.split('-');
                    if (fromParts.length === 3) {
                        fromDate = fromParts[2] + '-' + fromParts[1] + '-' + fromParts[0];
                    }
                }
                if (toDate) {
                    var toParts = toDate.split('-');
                    if (toParts.length === 3) {
                        toDate = toParts[2] + '-' + toParts[1] + '-' + toParts[0];
                    }
                }

               if (fromDate && toDate) {
                console.log(fromDate, toDate)
               }

               // Custom filter for date range (assuming column 1 is the date in d-m-Y format)
               $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                   var fromDate = $('#filterFromDate').val();
                   var toDate = $('#filterToDate').val();

                   // If both not given, show all
                   if (!fromDate && !toDate) return true;

                   // DataTable date in d-m-Y
                   var expenseDateStr = data[1];
                   if (!expenseDateStr) return false;

                   var parts = expenseDateStr.split('-');
                   if (parts.length !== 3) return false;
                   var expenseDate = new Date(parts[2], parts[1] - 1, parts[0]);

                   var from = fromDate ? new Date(fromDate) : null;
                   var to = toDate ? new Date(toDate) : null;

                   if (from && expenseDate < from) return false;
                   if (to && expenseDate > to) return false;

                   return true;
               });

                table.draw(); // trigger DT to re-filter using our custom filter below
            }


            // Bind applyDateRangeFilter() to button
            $('#btnApplyFilters').on('click', function(e) {
                e.preventDefault();
                applyDateRangeFilter();
            });

            // Exact Date Filter
            $('#filterExactDate').on('change', function() {
                var value = this.value;
                if (!value) {
                    table.column(1).search('').draw();
                    return;
                }
                var parts = value.split('-'); // [yyyy, mm, dd]
                if (parts.length === 3) {
                    var dmy = parts[2] + '-' + parts[1] + '-' + parts[0];
                    table.column(1).search('^' + dmy + '$', true, false).draw();
                } else {
                    table.column(1).search('').draw();
                }
            });

            // Category Filter (Column 3)
            $('#filterCategory').on('change', function() {
                var value = this.value;
                table.column(3).search(value ? '^' + $.fn.dataTable.util.escapeRegex(value) + '$' : '', true, false).draw();
            });

            // Transaction Type Filter (Column 2)
            $('#filterTransactionType').on('change', function() {
                var value = this.value;
                table.column(2).search(value ? $.fn.dataTable.util.escapeRegex(value) : '', true, false).draw();
            });

            // Payment Mode Filter (Column 6)
            $('#filterPaymentMode').on('change', function() {
                var value = this.value;
                table.column(6).search(value ? '^' + $.fn.dataTable.util.escapeRegex(value) + '$' : '', true, false).draw();
            });

            // Month/Year Filter
            $('#filterMonthYear').on('change', function() {
                var selectedMonthYear = this.value; // Format: yyyy-MM
                if (!selectedMonthYear) {
                    // Clear the search and show all rows
                    table.search('').columns().search('').draw();
                    return;
                }

                var parts = selectedMonthYear.split('-');
                var year = parts[0];
                var month = parts[1];

                // Search for dates matching the format dd-MM-yyyy
                var searchPattern = '-' + month + '-' + year;
                table.column(1).search(searchPattern, true, false).draw();
            });

            // Apply Date Range Filter
            $('#btnApplyFilters').on('click', function() {
                // Clear other date filters first
                $('#filterExactDate').val('');
                $('#filterMonthYear').val('');
                table.column(1).search('');

                // Trigger the custom date range filter
                table.draw();
            });

            // Clear date range when exact date is used
            $('#filterExactDate').on('change', function() {
                if (this.value) {
                    $('#filterFromDate').val('');
                    $('#filterToDate').val('');
                }
            });

            // Clear date range when month/year is used
            $('#filterMonthYear').on('change', function() {
                if (this.value) {
                    $('#filterFromDate').val('');
                    $('#filterToDate').val('');
                }
            });

            // Reset All Filters
            $('#btnResetFilters').on('click', function() {
                $('#filterMonthYear').val('');
                $('#filterCategory').val('');
                $('#filterExactDate').val('');
                $('#filterTransactionType').val('');
                $('#filterPaymentMode').val('');
                $('#filterFromDate').val('');
                $('#filterToDate').val('');

                table.search('').columns().search('').draw();
            });

            // Export to Excel
            $('#btnExportExcel').on('click', function() {
                table.button('.buttons-excel').trigger();
            });
        });
    </script>

    <!-- Include DataTables Buttons JS and JSZip for Excel export -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
@endsection
