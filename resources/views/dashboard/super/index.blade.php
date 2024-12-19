
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
    // Event listener untuk menangkap ID admin dan memasukkannya ke dalam form modal
    // document.querySelectorAll('button[data-customer-id]').forEach(button => {
    //     button.addEventListener('click', function () {
    //         const customerId = this.getAttribute('data-customer-id');
    //         document.getElementById('customer_id').value = customerId; // Masukkan ID admin ke input hidden
    //     });
    // });

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
{{-- 
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
            // Hitung total harga tanpa format ribuan atau koma
            const totalPrice = hours * pricePerHour;
            const roundedPrice = Math.floor(totalPrice / 1000) * 1000;
            
            // Kirim harga tanpa format ke modal
            document.getElementById('total_price').value = roundedPrice; // Tanpa format ribuan
            // hitung depe
            const depe = roundedPrice / 2;
            document.getElementById('depe').value = depe; // Tanpa format ribuan
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


// CALENDER
document.addEventListener('DOMContentLoaded', function () {
    let adminId = null;

    // Event listener untuk tombol yang membuka modal
    const scheduleButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#jadwalForm"]');
    
    scheduleButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Ambil admin_id dari tombol yang diklik
            adminId = button.getAttribute('data-admin-id');
            console.log('Admin ID:', adminId);

            // Kosongkan daftar pesanan sebelum modal dibuka
            document.getElementById('orderList').innerHTML = '';
        });
    });

    // Inisialisasi Flatpickr pada elemen div #calendar
    flatpickr("#calendar", {
        inline: true, // Menampilkan kalender di halaman tanpa input
        dateFormat: "Y-m-d", // Format tanggal yang diinginkan
        onChange: function (selectedDates, dateStr, instance) {
            if (adminId) {
                // Menangani event ketika tanggal dipilih dan admin_id sudah diambil
                console.log('Tanggal yang dipilih: ' + dateStr);
                // Panggil fungsi untuk mengambil pesanan berdasarkan tanggal dan admin_id
                fetchOrdersByDate(dateStr, adminId);
            } else {
                console.log('Admin ID tidak ditemukan!');
            }
        }
    });

    // Fungsi untuk mengambil data pesanan berdasarkan tanggal yang dipilih
    function fetchOrdersByDate(date, adminId) {
        var orderList = document.getElementById('orderList');
        orderList.innerHTML = ''; // Kosongkan daftar sebelumnya

        // Kirim request ke server untuk mendapatkan pesanan dengan admin_id dan tanggal
        fetch(`/schedule-by-date?date=${date}&admin_id=${adminId}`)
            .then(response => response.json())
            .then(orders => {
                if (orders.length === 0) {
                    orderList.innerHTML = '<li class="list-group-item">Tidak ada pesanan pada hari ini.</li>';
                } else {
                    orders.forEach(order => {
                        var listItem = document.createElement('li');
                        listItem.classList.add('list-group-item');
                        listItem.textContent = `Pesanan: ${order.start_time} - ${order.end_time}`;
                        orderList.appendChild(listItem);
                    });
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
                orderList.innerHTML = '<li class="list-group-item text-danger">Gagal mengambil data pesanan.</li>';
            });
    }

    // Event listener untuk saat modal ditutup
    $('#jadwalForm').on('hidden.bs.modal', function () {
        // Kosongkan daftar pesanan ketika modal ditutup
        document.getElementById('orderList').innerHTML = '';
    });
});



</script> --}}



  
@endsection
{{-- 
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


<!--  MODAL UNTUK CALENDER -->
<div class="modal fade" id="jadwalForm" tabindex="-1" aria-labelledby="jadwalFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jadwalFormLabel">Jadwal Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Kalender -->
                <div id="calendar"></div>
                <!-- Daftar pesanan -->
                <ul id="orderList" class="list-group mt-3"></ul>
            </div>
        </div>
    </div>
</div>

 --}}
