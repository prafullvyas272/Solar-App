@extends('layouts.layout')
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="card-title mb-0"><b>Expense Reports Dashboard</b></h5>
                <a href="/daily-expense" class="btn btn-primary" style="margin-right: 1rem;">
                    Dashboard View
                </a>
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
                            type="button"></button>
                    </li>

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
                                            <input type="date" id="fromDate" class="form-control" placeholder="From" />
                                        </div>
                                        <div
                                            class="col-auto text-center d-flex align-items-center justify-content-center mb-2 mb-sm-0">
                                            <span class="fw-semibold d-block w-100">to</span>
                                        </div>
                                        <div class="col-12 col-sm-5">
                                            <input type="date" id="toDate" class="form-control" placeholder="To" />
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
                                    <div
                                        class="card chart-card text-center h-100 py-3 position-relative"
                                        id="netProfitLossCard"
                                        style="overflow:hidden; background: url('/images/bg-profit-loss.svg') center/cover no-repeat, linear-gradient(125deg, #fffbe7 0%, #f0fff3 100%); min-height:220px;"
                                    >
                                        <div class="card-body position-relative" style="z-index: 2;">
                                            <div class="mb-2 d-flex justify-content-center align-items-center" id="profitLossIconWrapper">
                                                <span
                                                    id="profitLossCircle"
                                                    class="rounded-circle p-3 d-flex align-items-center justify-content-center"
                                                    style="background: rgba(255,193,7,0.13); transition: background 0.5s;"
                                                >
                                                    <i id="profitLossIcon" class="fas fa-money-bill-wave fa-2x"
                                                        style="color:#007bff; transition:color 0.5s;">
                                                    </i>
                                                </span>
                                            </div>
                                            <h3 class="card-title fw-bold mb-2" id="profitLossHeading">Total Net Profit / Loss</h3>
                                            <div id="profitLossValueDisplay" class="display-6 fw-semibold text-primary" style="transition:color 0.4s;">
                                                <span id="totalNetProfit"></span>
                                            </div>
                                        </div>
                                        <!-- Optional Overlay for better UX and readability -->
                                        <div style="position:absolute; inset:0; background:linear-gradient(120deg,rgba(255,255,255,0.92) 60%,rgba(248,249,250,0.65)); z-index:1; pointer-events:none;"></div>
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
                            <h2 class="text-center">Monthly Income & Expenses</h2>
                            <canvas id="monthlyExpenseChart" height="100"></canvas>
                        </div>

                        <div class="my-5 chart-card">
                            <h2 class="text-center">Monthly Profit</h2>
                            <canvas id="monthlyProfitChart" height="100"></canvas>
                        </div>


                    </div>


                    <!-- 🏷 Category-wise -->
                    <div class="tab-pane fade" id="category">
                        <button type="button" class="btn btn-primary mb-3" onclick="document.getElementById('monthly-tab').click();">
                            Go to Bar Charts View
                        </button>
                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <div class="chart-card">
                                    <h4 class="text-center mb-3">Expense Categories</h4>
                                    <canvas id="categoryExpenseChart" height="200"></canvas>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="chart-card">
                                    <h4 class="text-center mb-3">Income Categories</h4>
                                    <canvas id="categoryIncomeChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
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
            const monthlyProfitCtx = document.getElementById('monthlyProfitChart');

            // Declare the chart variable so we can update it later
            let monthlyExpenseChart = null;
            let monthlyIncomeChart = null;
            let monthlyProfitChart = null;

            function fetchCategoryData(month, datasetIndex, monthName) {
                let year = $('#reportYearPicker').val();

                $.ajax({
                    url: '/api/V1/category-expense-data', // You'll need to create this endpoint
                    method: 'GET',
                    data: {
                        year: year,
                        month: month,
                        type: datasetIndex === 0 ? 'expense' : 'income'
                    },
                    headers: {
                        Authorization: "Bearer " + getCookie("access_token"),
                    },
                    success: function(response) {
                        // Update Expense Chart
                        if (response.expenseCategories) {
                            categoryExpenseChart.data.labels = response.expenseCategories.labels;
                            categoryExpenseChart.data.datasets[0].data = response.expenseCategories
                                .data;
                            categoryExpenseChart.options.plugins.title.text = monthName + ' - Expenses';
                            categoryExpenseChart.update();

                            // Update expense table
                            updateCategoryTable('expenseCategoryTable', response.expenseCategories
                                .labels,
                                response.expenseCategories.data);
                        }

                        // Update Income Chart
                        if (response.incomeCategories) {
                            categoryIncomeChart.data.labels = response.incomeCategories.labels;
                            categoryIncomeChart.data.datasets[0].data = response.incomeCategories.data;
                            categoryIncomeChart.options.plugins.title.text = monthName + ' - Income';
                            categoryIncomeChart.update();

                            // Update income table
                            updateCategoryTable('incomeCategoryTable', response.incomeCategories.labels,
                                response.incomeCategories.data);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching category data:', error);
                    }
                });
            }

            function updateCategoryTable(tableId, labels, data) {
                const tbody = document.getElementById(tableId);
                tbody.innerHTML = '';

                labels.forEach((label, index) => {
                    const row = `<tr>
            <td>${label}</td>
            <td>Rs. ${data[index].toLocaleString()}</td>
        </tr>`;
                    tbody.innerHTML += row;
                });
            }


            function renderPieCharts(response) {
                console.log(response)
                // 🏷 Category Charts (Pie) - Expense and Income
                const categoryExpenseCtx = document.getElementById('categoryExpenseChart');
                const categoryIncomeCtx = document.getElementById('categoryIncomeChart');

                const expenseLabels = response.monthly_expense_data.map(item => item.name);
                const expenseValues = response.monthly_expense_data.map(item => item.amount);


                const incomeLabels = response.monthly_income_data.map(item => item.name);
                const incomeValues = response.monthly_income_data.map(item => item.amount);

                console.log(expenseLabels, expenseValues)
                let categoryExpenseChart = new Chart(categoryExpenseCtx, {
                    type: 'pie',
                    data: {
                        labels: expenseLabels,
                        datasets: [{
                            data: expenseValues,
                            backgroundColor: ['#dc3545', '#fd7e14', '#ffc107', '#6c757d']
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            title: {
                                display: true,
                                text: 'All Months'
                            }
                        }
                    }
                });

                let categoryIncomeChart = new Chart(categoryIncomeCtx, {
                    type: 'pie',
                    data: {
                        labels: incomeLabels,
                        datasets: [{
                            data: incomeValues,
                            backgroundColor: ['#28a745', '#20c997', '#17a2b8', '#6610f2']
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            title: {
                                display: true,
                                text: 'All Months'
                            }
                        }
                    }
                });
            }



            // Replace the renderMonthlyExpenseChart function with this updated version

            function renderMonthlyExpenseChart(expenseData, incomeData, profitData) {
                const labels = [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ];

                // Combined Income & Expense Chart
                if (monthlyExpenseChart) {
                    monthlyExpenseChart.data.datasets[0].data = expenseData;
                    monthlyExpenseChart.data.datasets[1].data = incomeData;
                    monthlyExpenseChart.update();
                } else {
                    monthlyExpenseChart = new Chart(monthlyExpenseCtx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: 'Total Expenses (Rs.)',
                                    data: expenseData,
                                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Total Income (Rs.)',
                                    data: incomeData,
                                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            onClick: (event, activeElements) => {
                                if (activeElements.length > 0) {
                                    const selectedYear = $('#reportYearPicker').val();
                                    const index = activeElements[0]._index;
                                    let year = $('#reportYearPicker').val();

                                    // Ensure both monthName and monthIndex are sent as plain values
                                    const payload = {
                                        year: year,
                                        monthIndex: index
                                    };

                                    $.ajax({
                                        url: '/api/V1/category-expense-data?' + $.param(
                                            payload),
                                        method: 'GET',
                                        headers: {
                                            Authorization: "Bearer " + getCookie(
                                                "access_token"),
                                        },
                                        success: function(response) {
                                            renderPieCharts(response)
                                        },
                                        error: function(xhr, status, error) {
                                            // On error, show empty (or fallback to zeros)
                                            renderMonthlyExpenseChart([0, 0, 0, 0, 0, 0, 0,
                                                0, 0, 0, 0, 0
                                            ], [0,
                                                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
                                            ], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
                                        }
                                    });

                                    // Switch to category tab
                                    const categoryTab = new bootstrap.Tab(document.getElementById(
                                        'category-tab'));
                                    categoryTab.show();

                                    // You can make an AJAX call here to fetch category data for the selected month
                                    // fetchCategoryData(index + 1, datasetIndex, monthName);
                                }
                            },
                        }
                    });
                }

                // Remove the separate Income Chart code completely

                // Profit Chart (unchanged)
                if (monthlyProfitChart) {
                    monthlyProfitChart.data.datasets[0].data = profitData;
                    monthlyProfitChart.update();
                } else {
                    monthlyProfitChart = new Chart(monthlyProfitCtx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Profit (Rs.)',
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
                            let profit = response.totalNetProfit;
                            let $profitDisplay = $("#totalNetProfit");
                            let profitIcon, profitText, profitClass;
                            if (profit >= 0) {
                                profitIcon = '<i class="fas fa-arrow-up" style="color:#43a047;vertical-align:middle;font-size:1.2em;margin-right:5px;"></i>';
                                profitText = 'Profit: Rs. ' + Math.abs(profit).toFixed(2);;
                                profitClass = 'text-success fw-bold';
                                $profitDisplay.html('<span class="' + profitClass + '">' + profitIcon + profitText + '</span>');
                            } else {
                                profitIcon = '<i class="fas fa-arrow-down" style="color:#d32f2f;vertical-align:middle;font-size:1.2em;margin-right:5px;"></i>';
                                profitText = 'Loss: Rs. ' + Math.abs(profit).toFixed(2);
                                profitClass = 'text-danger fw-bold';
                                $profitDisplay.html('<span class="' + profitClass + '">' + profitIcon + profitText + '</span>');
                            }
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
                            let profit = response.totalNetProfit;
                            let $profitDisplay = $("#totalNetProfit");
                            let profitIcon, profitText, profitClass;
                            if (profit >= 0) {
                                profitIcon = '<i class="fas fa-arrow-up" style="color:#43a047;vertical-align:middle;font-size:1.2em;margin-right:5px;"></i>';
                                profitText = 'Profit: Rs. ' + Math.abs(profit).toFixed(2);;
                                profitClass = 'text-success fw-bold';
                                $profitDisplay.html('<span class="' + profitClass + '">' + profitIcon + profitText + '</span>');
                            } else {
                                profitIcon = '<i class="fas fa-arrow-down" style="color:#d32f2f;vertical-align:middle;font-size:1.2em;margin-right:5px;"></i>';
                                profitText = 'Loss: Rs. ' + Math.abs(profit).toFixed(2);
                                profitClass = 'text-danger fw-bold';
                                $profitDisplay.html('<span class="' + profitClass + '">' + profitIcon + profitText + '</span>');
                            }

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




        });
    </script>
@endsection
