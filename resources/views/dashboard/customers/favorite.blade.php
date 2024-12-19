


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

<ul class="box-info">
    <li>
        <i class='bx bxs-calendar-check'></i>
        <span class="text">
            <h3>{{ $totalOrders }}</h3>
            <p>New Order</p>
        </span>
    </li>
    <li>
        <i class='bx bxs-group'></i>
        <span class="text">
            <h3>{{ $totalCustomers }}</h3>
            <p>Visitors</p>
        </span>
    </li>
    <li>
        <i class='bx bxs-dollar-circle'></i>
        <span class="text">
            <h3>Rp.{{ $totalPrice }}</h3>
            <p>Total Sales</p>
        </span>
    </li>
</ul>



<div class="table-data">
    <div class="order">
        <div class="head">
            <h3>Recent Orders</h3>
            <a href="/dashboard-muatype/create" class="btn btn-primary mb-3">Tambah MUA Type</a>
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
        </div>


        <div id="statusButtons" class="mb-3">
            <button onclick="toggleForms('adminratingForm')" class="btn btn-warning">Make Up Artis</button>
            <button onclick="toggleForms('muatyperatingForm')" class="btn btn-primary">MUA Type</button>
            <form method="GET" action="{{ route('rating.index') }}" class="sortirrating">
                <label for="time_period">Pilih Periode Waktu:</label>
                <select name="time_period" id="time_period">
                    <option value="all" {{ request('time_period') == 'all' ? 'selected' : '' }}>Semua Waktu</option>
                    <option value="this_month" {{ request('time_period') == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="this_year" {{ request('time_period') == 'this_year' ? 'selected' : '' }}>Tahun Ini</option>
                </select>
                <button type="submit">Filter</button>
            </form>
        </div>

        
        
        
        

        

        <div id="adminratingForm" class="statusForm ">
            
            <h3>Favorit Admin</h3>

            
                <table>
                    <thead>
                        <tr>
                            <th>Nama Admin</th>
                            <th>Jumlah Pesanan</th>
                            <th>Rata-rata Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($favoriteAdmins as $admin)
                        <tr>
                            <td>{{ $admin->admin_name }}</td>
                            <td>{{ $admin->total_orders }}</td>
                            <td>{{ number_format($admin->average_rating, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
            
        </div>
        
        <!-- Form untuk Finished -->
        <div id="muatyperatingForm" class="statusForm hidden">
            
            <h3>Favorit Admin</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Muatype</th>
                            <th>Jumlah Pesanan</th>
                            <th>Rata-rata Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($favoriteMuaTypes as $muatype)
                        <tr>
                            <td>{{ $muatype->muatype_name }}</td>
                            <td>{{ $muatype->total_orders }}</td>
                            <td>{{ number_format($muatype->average_rating, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
            
        </div>
    </div>
</div>

<script>
    function toggleForms(status) {
    // Ambil referensi ke semua form
    const adminratingForm = document.getElementById('adminratingForm');
    const muatyperatingForm = document.getElementById('muatyperatingForm');

    // Sembunyikan semua form terlebih dahulu
    adminratingForm.classList.add('hidden');
    muatyperatingForm.classList.add('hidden');

    // Menampilkan form sesuai dengan tombol yang dipilih
    if (status === 'adminratingForm') {
        adminratingForm.classList.remove('hidden');
    } else if (status === 'muatyperatingForm') {
        muatyperatingForm.classList.remove('hidden');
    }
}


</script>


@endsection
