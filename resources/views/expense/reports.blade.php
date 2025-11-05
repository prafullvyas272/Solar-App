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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="daily-tab" data-bs-toggle="tab" data-bs-target="#daily"
                            type="button">Dashboard</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly"
                            type="button">Monthly Report</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="category-tab" data-bs-toggle="tab" data-bs-target="#category"
                            type="button">Category-wise</button>
                    </li>
                    <li class="nav-item">

                </ul>

                <div class="tab-content" id="expenseReportTabsContent">

                    <!-- 🗓 Daily Summary -->
                    <div class="tab-pane fade show active" id="daily">
                        <div class="container-fluid">
                            <div class="row g-3 align-items-end mb-4">
                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold" for="dailyDatePicker">Filter by Date:</label>
                                    <input type="date" id="customDate" class="form-control" />
                                </div>
                                <div class="col-12 col-md-8">
                                    <label class="form-label fw-bold mb-2" for="customRangeStart">Custom Range:</label>
                                    <div class="row gx-2 align-items-center">
                                        <div class="col-12 col-sm-5 mb-2 mb-sm-0">
                                            <input type="date" id="fromDate" class="form-control"
                                                placeholder="From" />
                                        </div>
                                        <div
                                            class="col-auto text-center d-flex align-items-center justify-content-center mb-2 mb-sm-0">
                                            <span class="fw-semibold d-block w-100">to</span>
                                        </div>
                                        <div class="col-12 col-sm-5">
                                            <input type="date" id="toDate" class="form-control"
                                                placeholder="To" />
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" id="applyRangeBtn" class="btn btn-primary">
                                                Apply
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="table-responsive">
                                <table class="table table-bordered text-center w-100" style="min-width:550px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Total Income</th>
                                            <th>Total Expense</th>
                                            <th>Net Profit/Loss</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>₹1,50,000</td>
                                            <td>₹90,000</td>
                                            <td>₹60,000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}

                            <div class="row g-3 mb-4">
                                <div class="col-12 col-md-4">
                                    <div class="card chart-card text-center h-100 py-3">
                                        <div class="card-body">
                                            <div class="mb-2 d-flex justify-content-center align-items-center">
                                                <span
                                                    class="bg-danger bg-opacity-10 rounded-circle p-3 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-wallet fa-2x text-danger"></i>
                                                </span>
                                            </div>
                                            <h3 class="card-title fw-bold mb-2">Total Net Expense</h3>
                                            <div class="display-6 fw-semibold text-danger">Rs. <span
                                                    id="totalNetExpense"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="card chart-card text-center h-100 py-3">
                                        <div class="card-body">
                                            <div class="mb-2 d-flex justify-content-center align-items-center">
                                                <span
                                                    class="bg-success bg-opacity-10 rounded-circle p-3 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-coins fa-2x text-success"></i>
                                                </span>
                                            </div>
                                            <h3 class="card-title fw-bold mb-2">Total Net Income</h3>
                                            <div class="display-6 fw-semibold text-success">Rs. <span
                                                    id="totalNetIncome"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="card chart-card text-center h-100 py-3">
                                        <div class="card-body">
                                            <div class="mb-2 d-flex justify-content-center align-items-center">
                                                <span
                                                    class="bg-warning bg-opacity-10 rounded-circle p-3 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-money-bill-wave fa-2x text-primary"></i>
                                                </span>
                                            </div>
                                            <h3 class="card-title fw-bold mb-2">Total Net Profit</h3>
                                            <div class="display-6 fw-semibold text-primary">Rs. <span
                                                    id="totalNetProfit"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
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


                        <div class="my-5 chart-card">
                            <h2 class="text-center">Monthly Expenses</h2>
                            <canvas id="monthlyExpenseChart" height="100"></canvas>
                        </div>

                        <div class="my-5 chart-card">
                            <h2 class="text-center">Monthly Income</h2>
                            <canvas id="monthlyIncomeChart" height="100"></canvas>
                        </div>

                        <div class="my-5 chart-card">
                            <h2 class="text-center">Monthly Profit</h2>
                            <canvas id="monthlyProfitChart" height="100"></canvas>
                        </div>


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
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .text-center {
            text-align: center;
        }

        .chart-card {
            padding: 2rem 1.5rem;
            background: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
    </style>

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
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
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
                if (monthlyProfitChart) {
                    monthlyProfitChart.data.datasets[0].data = profitData;
                    monthlyProfitChart.update();
                } else {
                    monthlyProfitChart = new Chart(monthlyProfitCtx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Profit (Rs. )',
                                data: profitData,
                                backgroundColor: 'rgba(255, 206, 86, 0.6)',
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
                        data: {
                            year: year
                        },
                        headers: {
                            Authorization: "Bearer " + getCookie("access_token"),
                        },
                        success: function(response) {
                            $("#totalNetProfit").text(response.totalNetProfit)
                            $("#totalNetIncome").text(response.totalNetIncome)
                            $("#totalNetExpense").text(response.totalNetExpense)

                            renderMonthlyExpenseChart(response.expenseData, response.incomeData,
                                response.profitData);
                        },
                        error: function(xhr, status, error) {
                            // On error, show empty (or fallback to zeros)
                            renderMonthlyExpenseChart([0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0,
                                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
                            ], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
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
                        data: {
                            year: year
                        },
                        headers: {
                            Authorization: "Bearer " + getCookie("access_token"),
                        },
                        success: function(response) {
                            renderMonthlyExpenseChart(response.expenseData, response
                                .incomeData, response.profitData);
                        },
                        error: function(xhr, status, error) {
                            // On error, show empty (or fallback to zeros)
                            renderMonthlyExpenseChart([0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                                0
                            ], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0,
                                0, 0, 0, 0, 0, 0, 0, 0, 0
                            ]);
                        }
                    });
                });


                // When the applyRangeBtn change
                $('#applyRangeBtn').on('click', function() {
                    let customDate = $("#customDate").val();
                    let fromDate = $("#fromDate").val();
                    let toDate = $("#toDate").val();

                    $.ajax({
                        url: '/api/V1/daily-expense-data',
                        method: 'GET',
                        data: {
                            customDate: customDate,
                            fromDate: fromDate,
                            toDate: toDate,
                        },
                        headers: {
                            Authorization: "Bearer " + getCookie("access_token"),
                        },
                        success: function(response) {
                            $("#totalNetProfit").text(response.totalNetProfit)
                            $("#totalNetIncome").text(response.totalNetIncome)
                            $("#totalNetExpense").text(response.totalNetExpense)
                            renderMonthlyExpenseChart(response.expenseData, response
                                .incomeData, response.profitData);
                        },
                        error: function(xhr, status, error) {
                            // On error, show empty (or fallback to zeros)
                            renderMonthlyExpenseChart([0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                                0
                            ], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0,
                                0, 0, 0, 0, 0, 0, 0, 0, 0
                            ]);
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
