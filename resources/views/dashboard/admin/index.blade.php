
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
            <a href="/dashboard-muatype/create" class="btn btn-primary mb-3">Tambah MUA Type</a>
            <h3>Recent Orders</h3>
            
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Spesialisasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admin as $admins)
                <tr class="clickable-row" data-admin-id="{{ $admins->id }}">
                    <td>{{ $admins->user->name }}</td>
                    <td>{{ $admins->user->email }}</td>
                    <td>
                        @if($admins->muatypes->isNotEmpty())
                            @foreach($admins->muatypes as $muatype)
                                {{ $muatype->nama_mua }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            Tidak ada spesialisasi
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#spesialisasiForm" data-admin-id="{{ $admins->id }}">
                            Tambah Spesialisasi
                        </button>
                    </td>
                </tr>
                <tr class="details-row" id="details-{{ $admins->id }}" style="display: none;">
                    <td colspan="4">
                        <div class="details-row-card">
                            <div class="card-photo">
                                <img src="/img/babang.jpg" alt="{{ $admins->name }}">
                            </div>
                            <div class="card-details">
                                <p><span>Rincian untuk:</span> {{ $admins->name }}</p>
                                <p><span>Email:</span> {{ $admins->email }}</p>
                                <p class="spesialisasi"><span>Spesialisasi:</span> 
                                    @if($admins->muatypes->isNotEmpty())
                                        @foreach($admins->muatypes as $muatype)
                                            {{ $muatype->nama_mua }}@if(!$loop->last), @endif
                                        @endforeach
                                    @else
                                        Tidak ada spesialisasi
                                    @endif
                                </p>
                            </div>
                        </div>
                    </td>
                </tr>


                
                
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>

{{ $admin->links() }}
{{ $muatypes->links() }}


<!-- Modal Form for Spesialisasi -->

<script>
    // Event listener untuk menangkap ID admin dan memasukkannya ke dalam form modal
    document.querySelectorAll('button[data-admin-id]').forEach(button => {
        button.addEventListener('click', function () {
            const adminId = this.getAttribute('data-admin-id');
            document.getElementById('admin_id').value = adminId; // Masukkan ID admin ke input hidden
        });
    });

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

<div class="modal fade" id="spesialisasiForm" tabindex="-1" aria-labelledby="spesialisasiFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="spesialisasiFormLabel">Tambah Spesialisasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="spesialisasiFormContent" method="POST" action="/spesialisasi">
                    @csrf
                    <input type="hidden" name="admin_id" id="admin_id">

                    <div class="mb-3">
                        <label for="muatype_id" class="form-label">Pilih MUA Type:</label>
                        <select class="form-select" name="muatype_id" id="muatype_id" required>
                            <option value="" disabled selected>Pilih spesialisasi</option>
                            @foreach ($muatypes as $muatype)
                                <option value="{{ $muatype->id }}">{{ $muatype->nama_mua }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

