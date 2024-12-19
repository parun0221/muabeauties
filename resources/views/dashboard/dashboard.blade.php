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
</div><div class="super-admin-dashboard">
    <ul class="superad-info-mua">
        <li>
            <i class='bx bxs-brush'></i>
            <span class="superad-text-mua">
                <h3>Manage MUA</h3>
                <p><a href="/dashboard-admin">Kelola MUA</a></p>
            </span>
        </li>
        <li>
            <i class='bx bxs-photo-album'></i>
            <span class="superad-text-mua">
                <h3>Manage User</h3>
                <p><a href="/dashboard-customer">Kelola User</a></p>
            </span>
        </li>
        <li>
            <i class='bx bxs-calendar'></i>
            <span class="superad-text-mua">
                <h3>Booking System</h3>
                <p><a href="/order">Atur Pemesanan</a></p>
            </span>
        </li>
        <li>
            <i class='bx bxs-star'></i>
            <span class="superad-text-mua">
                <h3>Ratings & Reviews</h3>
                <p><a href="/ratings">Kelola Ulasan</a></p>
            </span>
        </li>
        <li>
            <i class='bx bxs-color-palette'></i>
            <span class="superad-text-mua">
                <h3>Customize Theme</h3>
                <p><a href="/themes">Sesuaikan Tema</a></p>
            </span>
        </li>
        <li>
            <i class='bx bxs-bar-chart-alt-2'></i>
            <span class="superad-text-mua">
                <h3>View Reports</h3>
                <p><a href="/reports">Lihat Laporan</a></p>
            </span>
        </li>
    </ul>

    <div class="main-content">
        <!-- Form untuk memilih bulan dan tahun -->
        <form method="GET" action="{{ route('dashboard.index') }}" class="filter-form">
            <label for="month">Pilih Bulan:</label>
            <select name="month" id="month">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $i == $month ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                    </option>
                @endfor
            </select>
    
            <label for="year">Pilih Tahun:</label>
            <select name="year" id="year">
                @for ($i = 2020; $i <= \Carbon\Carbon::now()->year; $i++)
                    <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
    
            <button type="submit">Tampilkan Grafik</button>
        </form>
    
        <!-- Grafik Pesanan -->
        <div class="chart-container">
            <canvas id="ordersChart" width="400" height="200"></canvas>
        </div>
    </div>
    
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var monthlyOrders = @json($monthlyOrders); // Data dari controller

    var labels = Object.keys(monthlyOrders).map(function(date) {
        return date.slice(-2); // Hanya ambil tanggal (contoh: '01', '02')
    });
    var data = Object.values(monthlyOrders); // Data jumlah pesanan

    var ctx = document.getElementById('ordersChart').getContext('2d');
    var ordersChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pesanan Bulan Ini',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: { display: true, text: 'Tanggal' }
                },
                y: {
                    title: { display: true, text: 'Jumlah Pesanan' },
                    ticks: { precision: 0, stepSize: 1 }
                }
            }
        }
    });
</script>





{{-- 

<div class="table-data">
    <div class="order">
        <div class="head">
            <h3>Recent Orders</h3>
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Date Order</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="{{ asset('img/people.png') }}">
                        <p>John Doe</p>
                    </td>
                    <td>01-10-2021</td>
                    <td><span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>
                        <img src="{{ asset('img/people.png') }}">
                        <p>John Doe</p>
                    </td>
                    <td>01-10-2021</td>
                    <td><span class="status pending">Pending</span></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div> --}}
@endsection
