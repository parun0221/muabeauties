
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
            <h3>1020</h3>
            <p>New Order</p>
        </span>
    </li>
    <li>
        <i class='bx bxs-group'></i>
        <span class="text">
            <h3>2834</h3>
            <p>Visitors</p>
        </span>
    </li>
    <li>
        <i class='bx bxs-dollar-circle'></i>
        <span class="text">
            <h3>$2543</h3>
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
        <table>
            <thead>
                <tr>
                    <th>Jenis Mua</th>
                    <th>Deskripsi</th>
                    <th>Harga/jam</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>

                @foreach($muatypes as $muatype)
                <tr>
                        <td>{{ $muatype->nama_mua }}</td>
                        <td>{{ $muatype->deskripsi }}</td>
                        <td>Harga per Jam: {{ $muatype->harga_per_jam }}</td>

    <!-- Menampilkan gambar -->
                        <td>
                     @if($muatype->gambar)
                        <img src="{{ asset('storage/' . $muatype->gambar) }}" alt="{{ $muatype->nama_mua }}" width="2000">
                    @endif
                        </td>
                </tr>
                @endforeach

                 
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>

{{ $muatypes->links() }}
@endsection
