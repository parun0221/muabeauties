
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
        <div class="head d-flex justify-content-between align-items-center mb-4">
            <h3>Recent Orders</h3>
            <a href="/dashboard-muatype/create" class="btn btn-primary">Tambah MUA Type</a>
            <div class="icons d-flex align-items-center">
                <i class='bx bx-search mx-2'></i>
                <i class='bx bx-filter'></i>
            </div>
        </div>
    

        <form action="/dashboard-muatype/" method="POST" enctype="multipart/form-data" class="p-4 shadow-sm bg-white rounded">
            @csrf
            <div class="form-group mb-3">
                <label for="nama_mua" class="form-label">Nama MUA</label>
                <input type="text" class="form-control" id="nama_mua" name="nama_mua" placeholder="Masukkan nama MUA" required>
            </div>

            <div class="form-group mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi singkat" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="harga_per_jam" class="form-label">Harga per Jam</label>
                <input type="number" class="form-control" id="harga_per_jam" name="harga_per_jam" placeholder="Masukkan harga per jam" required>
            </div>

            <div class="form-group mb-4">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
