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
                    <button class="nav-link active" id="daily-tab" data-bs-toggle="tab" data-bs-target="#daily" type="button">Daily Summary</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly" type="button">Monthly Report</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="category-tab" data-bs-toggle="tab" data-bs-target="#category" type="button">Category-wise</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="employee-tab" data-bs-toggle="tab" data-bs-target="#employee" type="button">Employee-wise</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customer" type="button">Customer-linked</button>
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
                                <th>Total Expenses (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(range(1,7) as $day)
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
                    <canvas id="monthlyChart" height="100"></canvas>
                </div>

                <!-- 🏷 Category-wise -->
                <div class="tab-pane fade" id="category">
                    <h6 class="fw-bold mb-3">Category-wise Expenses</h6>
                    <canvas id="categoryChart" height="100"></canvas>
                    <table class="table table-sm table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Total (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Office Supplies</td><td>₹5,200</td></tr>
                            <tr><td>Fuel</td><td>₹3,450</td></tr>
                            <tr><td>Maintenance</td><td>₹2,100</td></tr>
                            <tr><td>Other</td><td>₹950</td></tr>
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
                                <th>Total Amount (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Rahul Sharma</td><td>₹4,500</td></tr>
                            <tr><td>Priya Mehta</td><td>₹6,200</td></tr>
                            <tr><td>Ankit Verma</td><td>₹3,150</td></tr>
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
                                <th>Total Linked Expenses (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Ravi Patel</td><td>₹2,800</td></tr>
                            <tr><td>Neha Singh</td><td>₹1,950</td></tr>
                            <tr><td>Akash Kumar</td><td>₹3,400</td></tr>
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
    const monthlyCtx = document.getElementById('monthlyChart');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Total Expenses (₹)',
                data: [12000, 14500, 11000, 16500, 12500, 19000],
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
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
        options: { plugins: { legend: { position: 'bottom' } } }
    });

});
</script>
@endsection
