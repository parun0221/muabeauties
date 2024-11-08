
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
{{-- 
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
</ul> --}}

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
                    <th>Spesialisasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admin->muatypes as $muatypes)
                <tr class="clickable-row" data-admin-id="{{ $muatypes->id }}">
                    <td>
                        {{ $muatypes->nama_mua }}
                    </td>
                </tr>
                <tr class="details-row" id="details-{{ $muatypes->id }}" style="display: none;">
                    <td colspan="4">
                        <div class="details-row-cardg">
                            <div class="gallery-container">
                                <h2 class="gallery-title">Galeri Hasil Kerja untuk {{ $muatypes->nama_mua }}</h2>
                                <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#galeryForm" data-admin-mua-type-id="{{ $muatypes->pivot->id }}">Tambah Gambar</button>
                                
                                @if($muatypes->galerymua->isNotEmpty())
                                <table class="gallery-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 70%;">Gambar</th>
                                            <th style="width: 30%;">Keterangan</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($muatypes->galerymua as $galeri)
                                        <tr class="gallery-row">
                                            <td class="gallery-image">
                                                <img src="{{ asset('path/to/galeri/' . $galeri->gambar) }}" alt="Gambar Galeri MUA">
                                            </td>
                                            <td class="gallery-description">
                                                <p><strong>Keterangan:</strong> {{ $galeri->deskripsi }}</p>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p>Tidak ada gambar galeri untuk {{ $muatypes->nama_mua }}.</p>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
        
        
    </div>
</div>




<!-- Modal Form for Spesialisasi -->

<script>
    // Event listener untuk menangkap ID admin dan memasukkannya ke dalam form modal
    document.querySelectorAll('button[data-admin-mua-type-id]').forEach(button => {
    button.addEventListener('click', function () {
        const adminmuatypeId = this.getAttribute('data-admin-mua-type-id');
        console.log('Admin MUA Type ID:', adminmuatypeId); // Log ID yang diambil
        document.getElementById('admin-mua-type-id').value = adminmuatypeId; // Setel ID ke input hidden
    });
});

document.getElementById('galeryFormContent').addEventListener('submit', function (e) {
    const adminmuatypeId = document.getElementById('admin-mua-type-id').value;
    console.log('Submitting with Admin MUA Type ID:', adminmuatypeId); // Cek ID sebelum submit
    if (!adminmuatypeId) {
        e.preventDefault(); // Cegah form dari pengiriman
        alert('ID admin-mua-type tidak valid. Silakan coba lagi.');
    }
});

    // Menambahkan event listener setelah halaman sepenuhnya dimuat
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', function () {
            const adminId = this.getAttribute('data-admin-id');
            const detailsRow = document.getElementById('details-' + adminId);

            // Toggle visibility of the details row
            if (detailsRow.style.display === 'none' || detailsRow.style.display === '') {
                detailsRow.style.display = 'table-row'; // Show details row
            } else {
                detailsRow.style.display = 'none'; // Hide details row
            }
        });
    });
    
</script>

  
@endsection

<div class="modal fade" id="galeryForm" tabindex="-1" aria-labelledby="galeryFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galeryFormLabel">Tambah Galery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="galeryFormContent" method="POST" action="{{ route('galery.store') }} " enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="admin-mua-type-id" id="admin-mua-type-id">


                    <div class="mb-3">
                        <div class="form-group">
                            <label for="profile_photo">Profile Photo:</label>
                            <input type="file" name="galery" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Deskripsi:</label>
                            <input type="text" name="deskripsi" value="" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


 