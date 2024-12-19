
@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1> WELCOME {{ Auth::user()->name }} You Are {{ Auth::user()->role }} </h1>
<div class="head-title">
    <div class="left">
        <h1>Dashboard</h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Dashboard</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#">Home</a>
            </li>
        </ul>
    </div>
    <a href="#" class="btn-download">
        <i class='bx bxs-cloud-download'></i>
        <span class="text">Download PDF</span>
    </a>
</div>

<div class="table-data" >
    <div class="order">
        <div class="head">
            <h3>Recent Orders</h3>
            
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Total Pesanan</th>
                    <th>Gross Income</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admin as $admins)
                <tr class="clickable-row" data-admin-id="{{ $admins->id }}">
                    <td>{{ $admins->user->name }}</td>
                    <td>{{ $admins->user->email }}</td>
                    <td>
                        {{ $admins->order_count }}
                    </td>
                    <td> Rp {{ number_format($admins->order->sum('total_price'), 0, ',', '.') }} </td>
                    <td>
                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#spesialisasiForm" data-admin-id="{{ $admins->id }}">
                            Tambah Spesialisasi
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jadwalForm" data-admin-id="{{ $admins->id }}">
                            Jadwal
                        </button> --}}
                        <a href="/reports/{{$admins->id}}" class="btn btn-primary">
                            Detail
                        </a>
                        
                        
                    </td>
                </tr>
                


                
                
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>

<div class="reportsuper-main">
    
    <!-- Statistik Utama -->
    <div class="reportsuper-stats">
       
        <div class="reportsuper-stat-card">
            <i class='bx bxs-calendar'></i>
            <h3>Pesanan Pending</h3>
            <p>{{ $pendingOrders }} <br> Rp {{ number_format($totalEarningsp, 0, ',', '.') }}</p>
            
        </div>
        <div class="reportsuper-stat-card">
            <i class='bx bxs-calendar'></i>
            <h3>Pesanan Aktif</h3>
            <p>{{ $activeOrders }} <br> Rp {{ number_format($totalEarningsc, 0, ',', '.') }} </p>
            
        </div>
        <div class="reportsuper-stat-card">
            <i class='bx bxs-check-circle'></i>
            <h3>Pesanan Selesai</h3>
            <p>{{ $completedOrders }} <br> Rp {{ number_format($totalEarningsf, 0, ',', '.') }} </p>
           
        </div>
        <div class="reportsuper-stat-card">
            <i class='bx bxs-check-circle'></i>
            <h3>Pesanan Dibatalkan</h3>
            <p>{{ $cancelOrders }} <br> Rp {{ number_format($totalEarningscl, 0, ',', '.') }} </p>
           
        </div>
        
    </div>

    <main class="reportsuper-main">
        <!-- Canvas untuk Pie Chart -->
        <div class="reportsuper-chart">
            <h2>Pie Chart Pendapatan & Pesanan</h2>
            <canvas id="earningsChart"></canvas>
        </div>
    </main>
    
    <!-- Tambahkan Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    
    <script>
        // Pastikan ID Canvas sesuai
        const ctx = document.getElementById('earningsChart').getContext('2d');
    
        // Inisialisasi Pie Chart
        const earningsChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Selesai', 'Dikonfirmasi', 'Pending'],
                datasets: [{
                    label: 'Total Earnings',
                    data: [
                        {{ $totalEarningsf ?? 0 }},
                        {{ $totalEarningsc ?? 0 }},
                        {{ $totalEarningsp ?? 0 }}
                    ],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
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
    

    <!-- MUA Terpopuler -->
    <div class="reportsuper-popular-mua">
        <h2>MUA Paling Banyak Dipesan</h2>
        <div class="reportsuper-popular-card">
            <img src="{{ $popularMUA->profile_photo ? asset('storage/' . $popularMUA->profile_photo) : asset('/img/no-photo.png') }}" alt="Foto MUA">
            <p>{{ $popularMUA->admin_name }}</p>
            <p>Pesanan: {{ $popularMUA->total_orders }}</p>
        </div>
    </div>

    <!-- Review Terbanyak -->
    <div class="reportsuper-reviews">
        <h2>Review Terbanyak</h2>
        <div class="reportsuper-review-card">
            <i class='bx bxs-star'></i>
            <h3>{{ $mostReviewedMUA->nama }}</h3>
            <p>{{ $mostReviewedMUA->total_reviews }} Ulasan</p>
        </div>
    </div>
</div>




<!-- Modal Form for Spesialisasi -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Pemesanan',
                data: @json($chartData),
                borderColor: '#ff7eb3',
                backgroundColor: 'rgba(255, 126, 179, 0.2)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    
</script>




  
@endsection
