@extends('layouts.layout')
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="card-title mb-0"><b>Expense Reports Dashboard</b></h5>
            </div>

            <div class="card-body">
                <!-- Tabs -->
                <ul class="nav nav-tabs mb-4" id="expenseReportTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly"
                            type="button">Monthly Report</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="daily-tab" data-bs-toggle="tab" data-bs-target="#daily"
                            type="button">Daily Summary</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" id="category-tab" data-bs-toggle="tab" data-bs-target="#category"
                            type="button">Category-wise</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="employee-tab" data-bs-toggle="tab" data-bs-target="#employee"
                            type="button">Employee-wise</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customer"
                            type="button">Customer-linked</button>
                    </li>
                </ul>

                <div class="tab-content" id="expenseReportTabsContent">

                    <!-- 🗓 Daily Summary -->
                    <div class="tab-pane fade show active" id="daily">
                        <h6 class="fw-bold mb-3">Daily Expense Summary</h6>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Total Expenses (Rs. )</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (range(1, 7) as $day)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::now()->subDays($day)->format('d-m-Y') }}</td>
                                        <td>{{ number_format(rand(500, 3000), 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- 📅 Monthly Report -->
                    <div class="tab-pane fade" id="monthly">
                        <h6 class="fw-bold mb-3">Monthly Expense Report</h6>
                        <div class="mb-3">
                            <label for="reportYearPicker" class="form-label fw-bold">Select Year:</label>
                            <select id="reportYearPicker" class="form-select" style="width: auto; display: inline-block;">
                                @php
                                    $currentYear = now()->year;
                                    $startYear = $currentYear - 5;
                                    $endYear = $currentYear + 1;
                                    $selectedYear = request('year', $currentYear);
                                @endphp
                                @for ($year = $startYear; $year <= $endYear; $year++)
                                    <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>


                        <canvas id="monthlyExpenseChart" height="100"></canvas>

                        <canvas id="monthlyIncomeChart" height="100"></canvas>

                        <canvas id="monthlyProfitChart" height="100"></canvas>

                    </div>

                    <!-- 🏷 Category-wise -->
                    <div class="tab-pane fade" id="category">
                        <h6 class="fw-bold mb-3">Category-wise Expenses</h6>
                        <canvas id="categoryChart" height="100"></canvas>
                        <table class="table table-sm table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Total (Rs. )</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Office Supplies</td>
                                    <td>Rs. 5,200</td>
                                </tr>
                                <tr>
                                    <td>Fuel</td>
                                    <td>Rs. 3,450</td>
                                </tr>
                                <tr>
                                    <td>Maintenance</td>
                                    <td>Rs. 2,100</td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td>Rs. 950</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- 👨‍💼 Employee-wise -->
                    <div class="tab-pane fade" id="employee">
                        <h6 class="fw-bold mb-3">Employee-wise Expenses</h6>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Employee</th>
                                    <th>Total Amount (Rs. )</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Rahul Sharma</td>
                                    <td>Rs. 4,500</td>
                                </tr>
                                <tr>
                                    <td>Priya Mehta</td>
                                    <td>Rs. 6,200</td>
                                </tr>
                                <tr>
                                    <td>Ankit Verma</td>
                                    <td>Rs. 3,150</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- 👥 Customer-linked -->
                    <div class="tab-pane fade" id="customer">
                        <h6 class="fw-bold mb-3">Customer-linked Expenses</h6>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Customer</th>
                                    <th>Total Linked Expenses (Rs. )</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ravi Patel</td>
                                    <td>Rs. 2,800</td>
                                </tr>
                                <tr>
                                    <td>Neha Singh</td>
                                    <td>Rs. 1,950</td>
                                </tr>
                                <tr>
                                    <td>Akash Kumar</td>
                                    <td>Rs. 3,400</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // 📅 Monthly Chart (Bar)
            const monthlyExpenseCtx = document.getElementById('monthlyExpenseChart');
            const monthlyIncomeCtx = document.getElementById('monthlyIncomeChart');
            const monthlyProfitCtx = document.getElementById('monthlyProfitChart');

            // Declare the chart variable so we can update it later
            let monthlyExpenseChart = null;
            let monthlyIncomeChart = null;
            let monthlyProfitChart = null;


            function renderMonthlyExpenseChart(expenseData, incomeData, profitData) {
                const labels = [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ];
                // If chart exists, update it, else create it
                if (monthlyExpenseChart) {
                    monthlyExpenseChart.data.datasets[0].data = expenseData;
                    monthlyExpenseChart.update();
                } else {
                    monthlyExpenseChart = new Chart(monthlyExpenseCtx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Expenses (Rs. )',
                                data: expenseData,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                 // If chart exists, update it, else create it
                 if (monthlyIncomeChart) {
                    monthlyIncomeChart.data.datasets[0].data = incomeData;
                    monthlyIncomeChart.update();
                } else {
                    monthlyIncomeChart = new Chart(monthlyIncomeCtx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Income (Rs. )',
                                data: incomeData,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }




            }

            // 🟢 Initial fetch for the current year on page load
            $(document).ready(function() {
                function initialMonthlyExpenseChartLoad() {
                    let year = $('#reportYearPicker').val();
                    $.ajax({
                        url: '/api/V1/daily-expense-data',
                        method: 'GET',
                        data: { year: year },
                        headers: {
                            Authorization: "Bearer " + getCookie("access_token"),
                        },
                        success: function(response) {
                            renderMonthlyExpenseChart(response.expenseData, response.incomeData, response.profitData);
                        },
                        error: function(xhr, status, error) {
                            // On error, show empty (or fallback to zeros)
                            renderMonthlyExpenseChart([0,0,0,0,0,0,0,0,0,0,0,0], [0,0,0,0,0,0,0,0,0,0,0,0], [0,0,0,0,0,0,0,0,0,0,0,0]);
                        }
                    });
                }

                initialMonthlyExpenseChartLoad();

                // When the year selection changes, update the chart
                $('#reportYearPicker').on('change', function() {
                    let year = $(this).val();
                    $.ajax({
                        url: '/api/V1/daily-expense-data',
                        method: 'GET',
                        data: { year: year },
                        headers: {
                            Authorization: "Bearer " + getCookie("access_token"),
                        },
                        success: function(response) {
                            renderMonthlyExpenseChart(response.expenseData, response.incomeData, response.profitData);
                        },
                        error: function(xhr, status, error) {
                            // On error, show empty (or fallback to zeros)
                            renderMonthlyExpenseChart([0,0,0,0,0,0,0,0,0,0,0,0], [0,0,0,0,0,0,0,0,0,0,0,0], [0,0,0,0,0,0,0,0,0,0,0,0]);
                        }
                    });
                });
            });

            // 🏷 Category Chart (Pie)
            const categoryCtx = document.getElementById('categoryChart');
            new Chart(categoryCtx, {
                type: 'pie',
                data: {
                    labels: ['Office Supplies', 'Fuel', 'Maintenance', 'Other'],
                    datasets: [{
                        data: [5200, 3450, 2100, 950],
                        backgroundColor: ['#007bff', '#ffc107', '#28a745', '#dc3545']
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

        });
    </script>
@endsection
