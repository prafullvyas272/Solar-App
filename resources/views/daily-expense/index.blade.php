@extends('layouts.layout')
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div class="head-label text-center mb-2 mb-sm-0">
                    <h5 class="card-title mb-0"><b>Daily Expenses</b></h5>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ url('expense-reports') }}" class="btn btn-outline-info me-3">
                        <span class="tf-icons mdi mdi-chart-bar">&nbsp;</span>Ledger View
                    </a>
                    <button id="btnAddExpense" type="button" class="btn btn-primary waves-effect waves-light"
                        onClick="fnAddEdit(this, '{{ url('daily-expense/create') }}', 0, 'Add Daily Expense')">
                        <span class="tf-icons mdi mdi-plus">&nbsp;</span>Add Daily Expense
                    </button>
                </div>
            </div>

            <!-- 🔽 Filters Section -->
            <div class="p-3 border-top">
                <div class="row g-3">
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
                        <label for="filterExactDate" class="form-label">Filter by Date</label>
                        <input type="date" id="filterExactDate" class="form-control" />
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
                                <option value="{{ $modeValue }}">{{ $modeLabel }}</option>
                            @endforeach
                        </select>
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

    <!-- ✅ DataTable + Filter Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#dailyExpenseGrid').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                'language': {
                    "loadingRecords": "&nbsp;",
                    "processing": "<img src='{{ asset('assets/img/illustrations/loader.gif') }}' alt='loader' />"
                },
                order: [
                    [1, "desc"]
                ],
            });

            // 🔽 Exact Date Filter (fixed id case)
            $('#filterExactDate').on('change', function() {
                var value = this.value;
                // Expecting value in yyyy-mm-dd, but DataTable holds date as d-m-Y
                if (!value) {
                    table.column(1).search('').draw();
                    return;
                }
                var parts = value.split('-'); // [yyyy, mm, dd]
                if (parts.length === 3) {
                    var dmy = parts[2] + '-' + parts[1] + '-' + parts[0];
                    table.column(1).search('^' + dmy + '$', true, false, true).draw(); // Exact match
                } else {
                    table.column(1).search('').draw();
                }
            });

            // 🔽 Category Filter
            $('#filterCategory').on('change', function() {
                table.column(2).search(this.value).draw();
            });

            // 🔽 Paid By (Employee) Filter
            $('#filterEmployee').on('change', function() {
                table.column(6).search(this.value).draw();
            });

            // 🔽 Transaction Type Filter
            $('#filterTransactionType').on('change', function() {
                table.column(3).search(this.value).draw();
            });

            // 🔽 Payment Mode Filter
            $('#filterPaymentMode').on('change', function() {
                table.column(5).search(this.value).draw();
            });

            $('#filterFromDate, #filterToDate').on('change', function() {
                table.draw();
            });
            // 🔽 Linked Customer Filter
            $('#filterCustomer').on('change', function() {
                table.column(7).search(this.value).draw();
            });

            // 🔽 Month/Year Filter
            $('#filterMonthYear').on('change', function() {
                var selectedMonthYear = this.value; // Format: yyyy-MM
                if (!selectedMonthYear) {
                    table.columns(1).search('').draw();
                    return;
                }

                // Custom search by month-year in the Date column
                table.rows().every(function() {
                    var data = this.data();
                    var dateText = data[1]; // Date column (formatted as d-m-Y)
                    var dateParts = dateText.split('-');
                    var formatted = dateParts[2] + '-' + dateParts[1]; // yyyy-MM
                    if (formatted === selectedMonthYear) {
                        $(this.node()).show();
                    } else {
                        $(this.node()).hide();
                    }
                });
            });
        });
    </script>
@endsection
