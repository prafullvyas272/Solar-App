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
                        <span class="tf-icons mdi mdi-chart-bar">&nbsp;</span>Expense Reports
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
                            @foreach($expenseCategories as $cat)
                                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filterEmployee" class="form-label">Filter by Paid By (Employee)</label>
                        <select id="filterEmployee" class="form-select">
                            <option value="">All Employees</option>
                            @foreach($employees as $emp)
                                <option value="{{ trim(($emp->first_name ?? '') . ' ' . ($emp->middle_name ?? '') . ' ' . ($emp->last_name ?? '')) }}">
                                    {{ trim(($emp->first_name ?? '') . ' ' . ($emp->middle_name ?? '') . ' ' . ($emp->last_name ?? '')) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filterCustomer" class="form-label">Filter by Linked Customer</label>
                        <select id="filterCustomer" class="form-select">
                            <option value="">All Customers</option>
                            @foreach($customers as $cust)
                                <option value="{{ trim(($cust->first_name ?? '') . ' ' . ($cust->middle_name ?? '') . ' ' . ($cust->last_name ?? '')) }}">
                                    {{ trim(($cust->first_name ?? '') . ' ' . ($cust->middle_name ?? '') . ' ' . ($cust->last_name ?? '')) }}
                                </option>
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
                            <th>Category</th>
                            <th>Description</th>
                            <th>Amount (₹)</th>
                            <th>Payment Mode</th>
                            <th>Paid By</th>
                            <th>Linked Customer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dailyExpenses as $expense)
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
                                            <form action="{{ route('daily-expense.destroy', $expense->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this expense?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($expense->date)->format('d-m-Y') }}</td>
                                <td>
                                    {{ $expenseCategories->where('id', $expense->expense_category_id)->pluck('name')->first() ?? '-' }}
                                </td>
                                <td>{{ $expense->description ?? '-' }}</td>
                                <td>{{ number_format($expense->amount, 2) }}</td>
                                <td>{{ App\Enums\PaymentMode::getModes()[$expense->payment_mode] ?? '-' }}</td>
                                <td>
                                    {{ $expense->employee ? trim(($expense->employee->first_name ?? '') . ' ' . ($expense->employee->middle_name ?? '') . ' ' . ($expense->employee->last_name ?? '')) : '-' }}
                                </td>
                                <td>
                                    {{ $expense->customer ? trim(($expense->customer->first_name ?? '') . ' ' . ($expense->customer->middle_name ?? '') . ' ' . ($expense->customer->last_name ?? '')) : '-' }}
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

            // 🔽 Category Filter
            $('#filterCategory').on('change', function() {
                table.column(2).search(this.value).draw();
            });

            // 🔽 Paid By (Employee) Filter
            $('#filterEmployee').on('change', function() {
                table.column(6).search(this.value).draw();
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
