@extends('dashboard.layouts.app')

@section('content')
<div class="container salarymua">
    <h2 class="text-center my-4">Laporan Gaji Admin MUA</h2>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('reports.show', $admin->id) }}" class="d-flex justify-content-between align-items-center">
                <div class="row">
                    <div class="col-md-5">
                        <select name="month" class="form-select custom-select">
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="year" class="form-select custom-select">
                            @for($y = now()->year - 5; $y <= now()->year; $y++)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Filter</button>
            </form>
        </div>
    </div>

    <h4 class="text-center my-4">Report Admin: {{ $admin->user->name }}</h4>

    <div class="text-end mt-4">
        <a href="" class="btn btn-danger">Export to PDF</a>
        <a href="" class="btn btn-success">Export to Excel</a>
    </div> 

    <table class="table table-bordered text-center table-striped custom-table">
        <thead>
            <tr>
                <th>Status</th>
                <th>Jumlah</th>
                <th>Total Earnings</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Finished</td>
                <td>{{ $completedOrders }}</td>
                <td>{{ number_format($totalEarningsf, 2) }}</td>
            </tr>
            <tr>
                <td>Confirmed</td>
                <td>{{ $activeOrders }}</td>
                <td>{{ number_format($totalEarningsc, 2) }}</td>
            </tr>
            <tr>
                <td>Pending</td>
                <td>{{ $pendingOrders }}</td>
                <td>{{ number_format($totalEarningsp, 2) }}</td>
            </tr>
            <tr>
                <td>Canceled</td>
                <td>{{ $cancelOrders }}</td>
                <td>{{ number_format($totalEarningscl, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Salary</strong></td>
                <td colspan="2">
                    <strong>{{ number_format($salary, 2) }}</strong>
                </td>
            </tr>
        </tbody>
    </table>

    
        <!-- Canvas untuk Pie Chart -->
        <div class="reportsalary-chart">
            <h2>Pie Chart Pendapatan & Pesanan</h2>
            <canvas id="salaryChart"></canvas>
        </div>
    

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
    // Pastikan ID Canvas sesuai
    const ctx = document.getElementById('salaryChart').getContext('2d');

    // Inisialisasi Pie Chart
    const salaryChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Selesai', 'Dikonfirmasi', 'Pending', 'Dibatalkan'],
            datasets: [{
                label: 'Total Salary',
                data: [
                    {{ $totalEarningsf ?? 0 }},
                    {{ $totalEarningsc ?? 0 }},
                    {{ $totalEarningsp ?? 0 }},
                    {{ $totalEarningscl ?? 0 }} // Menggunakan data dari Canceled jika ada
                ],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF8D72'],
                borderWidth: 1
            }]
        },
        plugins: [ChartDataLabels],
        options: {
            plugins: {
                datalabels: {
                    formatter: (value, context) => {
                        const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1);
                        return `${percentage}%`;
                    },
                    color: '#fff',
                    font: {
                        size: 14,
                        family: 'Arial, sans-serif',
                        weight: 'bold'
                    }
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });
</script>

    
</div>
@endsection


