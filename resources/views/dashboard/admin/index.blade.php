
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
                                <img src="/img/babang.jpg" alt="{{ $admins->user->name }}">
                            </div>
                            <div class="card-details">
                                <p><span>Rincian untuk:</span> {{ $admins->user->name }}</p>
                                <p><span>Email:</span> {{ $admins->user->email }}</p>
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
                                <div class="card-buttons">
                                    <a href="/galery/{{$admins->id}}" class="btn btn-primary mb-3">Check my Galery</a>
                                    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#messageForm" data-receiver-id="{{ $admins->user->id }}">Kirim Pesan</a>
                                    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#bookingForm" data-admin-booking-id="{{ $admins->id }}">booking now</a>
                                
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

    
    document.querySelectorAll('[data-receiver-id]').forEach(button => {
    button.addEventListener('click', function () {
        const receiverId = this.getAttribute('data-receiver-id');
        document.getElementById('receiverId').value = receiverId; // Masukkan ID penerima ke input hidden
    });
});






    
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#message-form').on('submit', function(event) {
        event.preventDefault(); // Mencegah reload halaman

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // Mengambil URL dari action form
            data: $(this).serialize(), // Mengambil data dari form
            success: function(response) {
                // Menampilkan pesan baru di chat
                $('.chat-messages').append(
                    `<div class="message sent">
                        <p>${response.message}</p>
                        <small>${new Date(response.created_at).toLocaleTimeString()}</small>
                    </div>`
                );
                $('textarea[name="message"]').val(''); // Kosongkan textarea
            },
            error: function(xhr) {
                // Menampilkan error jika ada
                alert('Terjadi kesalahan saat mengirim pesan: ' + xhr.responseJSON.message);
            }
        });
    });
});


document.getElementById('bookingForm').addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget;
    const adminbookingId = button.getAttribute('data-admin-booking-id');
    document.getElementById('adminbookingId').value = adminbookingId;

    fetch(`/get-muatypes/${adminbookingId}`)
        .then(response => response.json())
        .then(data => {
            const muatypeSelect = document.getElementById('bookingmuatype_id');
            muatypeSelect.innerHTML = '<option value="" disabled selected>Pilih spesialisasi</option>';
            data.forEach(muatype => {
                const option = document.createElement('option');
                option.value = muatype.id;
                option.textContent = muatype.nama_mua;
                option.dataset.price = muatype.harga_per_jam;
                muatypeSelect.appendChild(option);
            });
        });

    const calculateTotalPrice = () => {
        const selectedMuaType = document.getElementById('bookingmuatype_id');
        const startTime = document.getElementById('start_time').value;
        const endTime = document.getElementById('end_time').value;
        const pricePerHour = selectedMuaType.options[selectedMuaType.selectedIndex]?.dataset?.price;

        if (startTime && endTime && pricePerHour) {
            const start = new Date(`01/01/2000 ${startTime}`);
            const end = new Date(`01/01/2000 ${endTime}`);
            const hours = (end - start) / 36e5; // Konversi dari ms ke jam

            if (hours > 0) {
                // Hitung total harga dan bulatkan ke ribuan terdekat
                const totalPrice = Math.floor((hours * pricePerHour) / 1000) * 1000;
                document.getElementById('total_price').value = `${totalPrice.toLocaleString()}`;
                // hitung depe
                const depe = totalPrice / 2 ;
                document.getElementById('depe').value = `${depe.toLocaleString()}`;
            } else {
                document.getElementById('total_price').value = 'Jam tidak valid';
            }
        }

    };

    document.getElementById('start_time').addEventListener('change', calculateTotalPrice);
    document.getElementById('end_time').addEventListener('change', calculateTotalPrice);
    document.getElementById('bookingmuatype_id').addEventListener('change', calculateTotalPrice);
});

document.getElementById('start_time').addEventListener('change', validateTimeDifference);
document.getElementById('end_time').addEventListener('change', validateTimeDifference);

function validateTimeDifference() {
    const startTime = document.getElementById('start_time').value;
    const endTime = document.getElementById('end_time').value;

    if (startTime && endTime) {
        const start = new Date(`01/01/2000 ${startTime}`);
        const end = new Date(`01/01/2000 ${endTime}`);
        const diffInHours = (end - start) / (1000 * 60 * 60); // Menghitung selisih dalam jam

        if (diffInHours < 1) {
            alert("Waktu berakhir harus minimal 1 jam setelah waktu mulai.");
            document.getElementById('end_time').value = ''; // Reset end_time jika tidak valid
        }
    }
}



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

<!-- Modal untuk Kirim Pesan -->
<div class="modal fade" id="messageForm" tabindex="-1" aria-labelledby="messageFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageFormLabel">Kirim Pesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="message-form" action="{{ route('message.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="receiver_id" id="receiverId">

                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea name="message" id="message" rows="4" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal booking -->

<div class="modal fade" id="bookingForm" tabindex="-1" aria-labelledby="bookingFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingFormLabel">Lakukan Pemesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookingFormContent" method="POST" action="{{ route('order.store') }}">
                    @csrf
                    <input type="hidden" name="adminbooking_id" id="adminbookingId">
                    
                    <!-- Pilihan Tanggal Booking -->
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Tanggal Booking:</label>
                        <input type="date" class="form-control" name="booking_date" id="booking_date" required>
                    </div>
                    
                    <!-- Pilihan Jam Mulai dan Jam Berakhir -->
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Jam Mulai:</label>
                        <input type="time" class="form-control" name="start_time" id="start_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_time" class="form-label">Jam Berakhir:</label>
                        <input type="time" class="form-control" name="end_time" id="end_time" required>
                    </div>
                    
                    <!-- Pilihan MUA Type -->
                    <div class="mb-3">
                        <label for="muatype_id" class="form-label">Pilih MUA Type:</label>
                        <select class="form-select" name="muatype_id" id="bookingmuatype_id" required>
                            <option value="" disabled selected>Pilih spesialisasi</option>
                            @foreach ($muatypes as $muatype)
                                <option value="{{ $muatype->id }}" data-price="{{ $muatype->harga_per_jam }}">
                                    {{ $muatype->nama_mua }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tampilan Total Harga -->
                    <div class="mb-3">
                        <label for="total_price" class="form-label">Total Harga:</label>
                        <input type="text" name="total_price" class="form-control" id="total_price" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="depe" class="form-label">DP:</label>
                        <input type="text" name="depe" class="form-control" id="depe" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
