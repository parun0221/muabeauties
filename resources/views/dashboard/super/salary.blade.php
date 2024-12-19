
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
                    <th>No.Tlp</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr class="clickable-row" data-customer-id="{{ $customer->id }}">
                    <td>{{ $customer->user->name }}</td>
                    <td>{{ $customer->user->email }}</td>
                    <td>082264495901</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#spesialisasiForm" data-customer-id="{{ $customer->id }}">
                            blokir
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jadwalForm" data-customer-id="{{ $customer->id }}">
                            reset password
                        </button>
                        
                        
                        
                    </td>
                </tr>
                <tr class="details-row" id="details-{{ $customer->id }}" style="display: none;">
                    <td colspan="4">
                        <div class="details-row-card">
                            <div class="card-photo">
                                <img src="/img/babang.jpg" alt="{{ $customer->user->name }}">
                            </div>
                            <div class="card-details">
                                <p><span>Rincian untuk:</span> {{ $customer->user->name }}</p>
                                <p><span>Email:</span> {{ $customer->user->email }}</p>
                                <p class="spesialisasi"><span>Telephone:</span> 
                                    082264495901
                                </p>
                                {{-- <p><span>Rata-rata Rating:</span> 
                                    @if($admins->average_rating)
                                        {{ number_format($admins->average_rating, 1) }} / 5
                                    @else
                                        Belum ada rating
                                    @endif
                                </p> --}}
                                </div>
                                {{-- <div class="card-buttons">
                                    <a href="/galery/{{$admins->id}}" class="btn btn-primary mb-3">Check my Galery</a>
                                    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#messageForm" data-receiver-id="{{ $admins->user->id }}">Kirim Pesan</a>
                                    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#bookingForm" data-admin-booking-id="{{ $admins->id }}">booking now</a>
                                
                                </div> --}}
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
    

    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', function () {
            const customerId = this.getAttribute('data-customer-id');
            const detailsRow = document.getElementById('details-' + customerId);

            // Toggle visibility of the details row
            if (detailsRow.style.display === 'none' || detailsRow.style.display === '') {
                detailsRow.style.display = 'table-row'; // Show details row
            } else {
                detailsRow.style.display = 'none'; // Hide details row
            }
        });
    });

    
    document.querySelectorAll('[data-receiver-id]').forEach(button => {
    button.addEventListener('click', function () {
        const receiverId = this.getAttribute('data-receiver-id');
        document.getElementById('receiverId').value = receiverId; // Masukkan ID penerima ke input hidden
    });
});






    
</script>




  
@endsection
