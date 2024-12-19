
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
    <a href="#" data-bs-toggle="modal" data-bs-target="#bayarForm" class="btn-download">
        <i class='bx bxs-cloud-download'></i>
        <span class="text">Cek Pembayaran</span>
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
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
        </div>

        @can('isSuper', Auth::user())        
            <table id="sortableTable">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Booking Date</th>
                        <th>Booking Time</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->customer && $order->customer->user ? $order->customer->user->name : 'Tidak ada user' }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->booking_date)->format('d M Y') }}</td>
                            <td>{{ $order->start_time }} - {{ $order->end_time }}</td>
                            <td>Rp.{{ $order->total_price }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            
                            {{-- <td><a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#ulasanForm" data-admin-id="{{ $order->admin_id }}" data-muatype-id="{{ $order->muatype_id }}" data-order-id="{{ $order->id }}">beri ulasan</a></td>
                            @endcan --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Tidak ada order yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            </table>
        @endcan


        @can('isAdmin', Auth::user())        
            <table id="sortableTable">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Booking Date</th>
                        <th>Booking Time</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->customer && $order->customer->user ? $order->customer->user->name : 'Tidak ada user' }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->booking_date)->format('d M Y') }}</td>
                            <td>{{ $order->start_time }} - {{ $order->end_time }}</td>
                            <td>Rp.{{ $order->total_price }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            
                            {{-- <td><a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#ulasanForm" data-admin-id="{{ $order->admin_id }}" data-muatype-id="{{ $order->muatype_id }}" data-order-id="{{ $order->id }}">beri ulasan</a></td>
                            @endcan --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Tidak ada order yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            </table>
        @endcan

        @can('isCustomer', Auth::user())  
        <div id="statusButtons" class="mb-3">
            <button onclick="toggleForms('pendingForm')" class="btn btn-warning">Pending</button>
            <button onclick="toggleForms('confirmForm')" class="btn btn-primary">Confirmed</button>
            <button onclick="toggleForms('finishForm')" class="btn btn-success">Finished</button>
        </div>
        
        <!-- Form untuk Pending -->
        <div id="pendingForm" class="statusForm ">
            <h3>Pesanan Pending</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama MUA</th>
                        <th>Mua Type</th>
                        <th>Tanggal Pesanan</th>
                        <th>Waktu Pesanan</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders['pending'] as $order)
                    <tr>
                        <td>{{ $order->admin->user->name }}</td>
                        <td><img src="{{ asset('storage/' . $order->muatype->gambar) }}" ></td>
                        <td>{{ \Carbon\Carbon::parse($order->booking_date)->format('d M Y') }}</td>
                        <td>{{ $order->start_time }} - {{ $order->end_time }}</td>
                        <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>

                            <!-- Link Pembayaran -->

                            <a href="#" onclick="return confirm('Setelah Melakukan Pemabyaran PEsanan Tidak bisa diubah Apakah kamu yakin ?')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PaymentForm" data-order-id="{{ $order->id }}" >
                                Lakukan Pembayaran
                            </a>

                            <!-- Link Edit -->
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateOrderForm" data-order-id="{{ $order->id }}" data-price-hour="{{$order->muatype->harga_per_jam}}">
                                Edit Pesanan
                            </a>
                        
                            <!-- Link Hapus -->
                            
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="cancelOrder({{ $order->id }})">
                                Batalkan
                            </a>
                            
                            <script>
                                function cancelOrder(id) {
                                    if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
                                        fetch(`/order/cancel/${id}`, {
                                            method: 'PUT', // Menggunakan method PUT karena kita hanya memperbarui data
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Content-Type': 'application/json'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            console.log('Response data:', data); // Log respons untuk debugging
                                            if (data.success) {
                                                alert('Pesanan berhasil dibatalkan.');
                                                location.reload(); // Muat ulang halaman setelah berhasil
                                            } else {
                                                alert('Gagal membatalkan pesanan.');
                                            }
                                        })
                                        .catch(error => console.error('Error:', error)); // Log kesalahan untuk debugging
                                    }
                                }
                            </script>
                            
                            
                            
                            
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Tidak ada pesanan pending.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Form untuk Confirmed -->
        <div id="confirmForm" class="statusForm hidden">
            <h3>Pesanan Confirmed</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama MUA</th>
                        <th>Tanggal Pesanan</th>
                        <th>Waktu Pesanan</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders['confirmed'] as $order)
                    <tr>
                        <td>{{ $order->admin->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->booking_date)->format('d M Y') }}</td>
                        <td>{{ $order->start_time }} - {{ $order->end_time }}</td>
                        <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="finishOrder({{ $order->id }})">
                                Selesaikan Pesanan
                            </a>
                            
                            <script>
                                function finishOrder(id) {
                                    if (confirm('Apakah Anda yakin ingin menyelesaikan pesanan ini?')) {
                                        fetch(`/order/finish/${id}`, {
                                            method: 'PUT',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Content-Type': 'application/json'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            console.log('Response data:', data); // Log respons untuk debugging
                                            if (data.success) {
                                                alert('Pesanan berhasil diselesaikan.');
                                                location.reload(); // Memuat ulang halaman
                                            } else {
                                                alert('Gagal menyelesaikan pesanan.');
                                            }
                                        })
                                        .catch(error => console.error('Error:', error)); // Log error untuk debugging
                                    }
                                }
                            </script>
                            

                           
                        
                            <!-- Link Hapus -->
                            
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="cancelOrder({{ $order->id }})">
                                Batalkan
                            </a>
                            
                            <script>
                                function cancelOrder(id) {
                                    if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
                                        fetch(`/order/cancel/${id}`, {
                                            method: 'PUT', // Menggunakan method PUT karena kita hanya memperbarui data
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Content-Type': 'application/json'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            console.log('Response data:', data); // Log respons untuk debugging
                                            if (data.success) {
                                                alert('Pesanan berhasil dibatalkan.');
                                                location.reload(); // Muat ulang halaman setelah berhasil
                                            } else {
                                                alert('Gagal membatalkan pesanan.');
                                            }
                                        })
                                        .catch(error => console.error('Error:', error)); // Log kesalahan untuk debugging
                                    }
                                }
                            </script>
                            
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Tidak ada pesanan confirmed.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Form untuk Finished -->
        <div id="finishForm" class="statusForm hidden">
            <h3>Pesanan Finished</h3>
            <table class="table ">
                <thead>
                    <tr>
                        <th>Nama MUA</th>
                        <th>Tanggal Pesanan</th>
                        <th>Waktu Pesanan</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders['finished'] as $order)
                    <tr>
                        <td>{{ $order->admin->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->booking_date)->format('d M Y') }}</td>
                        <td>{{ $order->start_time }} - {{ $order->end_time }}</td>
                        <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td><a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#ulasanForm" data-admin-id="{{ $order->admin_id }}" data-muatype-id="{{ $order->muatype_id }}" data-order-id="{{ $order->id }}">beri ulasan</a></td>
                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Tidak ada pesanan finished.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        
        @endcan


    </div>
</div>

<script>

$(document).ready(function() {
        $('#sortableTable').DataTable({
            "ordering": true,     // Aktifkan sorting
            "paging": true,       // Aktifkan pagination
            "searching": true,    // Aktifkan pencarian
            "info": true,         // Tampilkan informasi jumlah data
            "lengthChange": true, // Aktifkan opsi jumlah data per halaman
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Indonesian.json" // Terjemahan bahasa Indonesia
            }
        });
    });

@can('isCustomer', Auth::user())  
    // Event listener saat tombol "beri ulasan" diklik
document.querySelectorAll('[data-bs-target="#ulasanForm"]').forEach(button => {
    button.addEventListener('click', function () {
        // Mendapatkan ID dari atribut data di tombol
        const adminId = this.getAttribute('data-admin-id');
        const muatypeId = this.getAttribute('data-muatype-id');
        const orderId = this.getAttribute('data-order-id');
        
        // Memasukkan ID ke dalam input tersembunyi di dalam modal
        document.querySelector('#ulasanForm #admin_id').value = adminId;
        document.querySelector('#ulasanForm #muatype_id').value = muatypeId;
        document.querySelector('#ulasanForm #order_id').value = orderId;
    });
});

document.querySelectorAll('[data-bs-target="#PaymentForm"]').forEach(button => {
    button.addEventListener('click', function () {
        // Mendapatkan ID dari atribut data di tombol
        
        const orderId = this.getAttribute('data-order-id');
        
        // Memasukkan ID ke dalam input tersembunyi di dalam modal
        
        document.querySelector('#PaymentForm #order-id').value = orderId;
    });
});


    

    function toggleForms(status) {
    // Ambil referensi ke semua form
    const pendingForm = document.getElementById('pendingForm');
    const confirmForm = document.getElementById('confirmForm');
    const finishForm = document.getElementById('finishForm');

    // Sembunyikan semua form terlebih dahulu
    pendingForm.classList.add('hidden');
    confirmForm.classList.add('hidden');
    finishForm.classList.add('hidden');

    // Menampilkan form sesuai dengan tombol yang dipilih
    if (status === 'pendingForm') {
        pendingForm.classList.remove('hidden');
    } else if (status === 'confirmForm') {
        confirmForm.classList.remove('hidden');
    } else if (status === 'finishForm') {
        finishForm.classList.remove('hidden');
    }
}

// edit pesanan
let pricePerHour = 0; // Variabel global untuk price per hour

document.addEventListener('DOMContentLoaded', function () {
    const updateOrderForm = document.getElementById('updateOrderForm');

    updateOrderForm.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const orderId = button.getAttribute('data-order-id');

        // Ambil nilai dari atribut data-price-hour dan simpan ke variabel global
        pricePerHour = parseFloat(button.getAttribute('data-price-hour')) || 0;

        // Kirim nilai ke input hidden di modal
        const hiddenPriceInput = document.getElementById('hidden-price-per-hour');
        hiddenPriceInput.value = pricePerHour;

        const form = updateOrderForm.querySelector('form');
        form.action = `/order/${orderId}`;

        // Fetch data pesanan dari server
        fetch(`/order/${orderId}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modal-booking_date').value = data.booking_date;
                document.getElementById('modal-start_time').value = data.start_time;
                document.getElementById('modal-end_time').value = data.end_time;
                document.getElementById('modal-total_price').value = data.total_price;
                document.getElementById('modal-dp').value = data.dp;
            })
            .catch(error => console.error('Error fetching order data:', error));
    });

    const calculateTotalPrice = () => {
        const startTime = document.getElementById('modal-start_time').value;
        const endTime = document.getElementById('modal-end_time').value;

        if (startTime && endTime && pricePerHour) {
            const start = new Date(`01/01/2000 ${startTime}`);
            const end = new Date(`01/01/2000 ${endTime}`);
            const hours = (end - start) / 36e5; // Konversi dari ms ke jam

            if (hours > 0) {
                // Hitung total harga
                const totalPrice = hours * pricePerHour;
                const roundedPrice = Math.floor(totalPrice / 1000) * 1000;

                // Update nilai total harga dan DP di modal
                document.getElementById('modal-total_price').value = roundedPrice; // Harga tanpa format
                document.getElementById('modal-dp').value = roundedPrice / 2; // DP setengah dari harga
            } else {
                document.getElementById('modal-total_price').value = 'Jam tidak valid';
                document.getElementById('modal-dp').value = '';
            }
        }
    };

    const validateTimeDifference = () => {
        const startTime = document.getElementById('modal-start_time').value;
        const endTime = document.getElementById('modal-end_time').value;

        if (startTime && endTime) {
            const start = new Date(`01/01/2000 ${startTime}`);
            const end = new Date(`01/01/2000 ${endTime}`);
            const diffInHours = (end - start) / (1000 * 60 * 60);

            if (diffInHours < 1) {
                alert("Waktu berakhir harus minimal 1 jam setelah waktu mulai.");
                document.getElementById('modal-end_time').value = ''; // Reset end_time jika tidak valid
            }
        }
    };

    // Tambahkan event listener
    document.getElementById('modal-start_time').addEventListener('change', calculateTotalPrice);
    document.getElementById('modal-end_time').addEventListener('change', calculateTotalPrice);
    document.getElementById('modal-start_time').addEventListener('change', validateTimeDifference);
    document.getElementById('modal-end_time').addEventListener('change', validateTimeDifference);
});


    // PAYMENT JS

    document.addEventListener('DOMContentLoaded', () => {
    const paymentMethod = document.getElementById('payment-method');
    const paymentType = document.getElementById('payment-type');
    const paymentInfo = document.getElementById('payment-info');
    const totalPayment = document.getElementById('total-payment');

    // Data nomor rekening atau e-wallet
    const paymentDetails = {
        bank_bri: "Rekening BRI: 123-456-789 a.n. PT. MUA",
        bank_nagari: "Rekening Bank Nagari: 987-654-321 a.n. PT. MUA",
        dana: "Dana: 081234567890 a.n. PT. MUA",
        gopay: "GoPay: 081234567890 a.n. PT. MUA"
    };

    // Update informasi pembayaran
    const updatePaymentInfo = () => {
        const method = paymentMethod.value;
        const type = paymentType.value;
        let total = parseFloat(totalPayment.dataset.originalPrice);

        if (type === 'dp') {
            total *= 0.5; // DP 50%
        }

        paymentInfo.value = paymentDetails[method];
        totalPayment.value = `Rp ${total.toLocaleString('id-ID')}`;
    };

    // Event listener
    paymentMethod.addEventListener('change', updatePaymentInfo);
    paymentType.addEventListener('change', updatePaymentInfo);

    // Set original total price
    @if(isset($order))
        totalPayment.dataset.originalPrice = "{{ $order->total_price }}";
    @else
        console.error("Order data is not available.");
    @endif
    updatePaymentInfo();
});

@endcan
// PENDING PAYMENT
document.addEventListener('DOMContentLoaded', () => {
        // Ambil semua elemen dengan class 'payment-detail' untuk memproses data
        const paymentDetails = document.querySelectorAll('.payment-detail');

        paymentDetails.forEach(detail => {
            // Ambil data dari atribut data-* pada elemen
            const paymentMethod = detail.dataset.paymentMethod;
            const paymentType = detail.dataset.paymentType;
            const totalPrice = detail.dataset.totalPrice;
            const dpAmount = detail.dataset.dpAmount;

            // Tentukan teks yang akan ditampilkan untuk metode pembayaran
            let methodText = '';
            if (paymentMethod === 'bank_bri') {
                methodText = 'Rekening BRI: 123-456-789 a.n. PT. MUA';
            } else if (paymentMethod === 'bank_nagari') {
                methodText = 'Rekening Bank Nagari: 987-654-321 a.n. PT. MUA';
            } else if (paymentMethod === 'dana') {
                methodText = 'Dana: 081234567890 a.n. PT. MUA';
            } else if (paymentMethod === 'gopay') {
                methodText = 'GoPay: 081234567890 a.n. PT. MUA';
            }

            // Tentukan nilai yang akan ditampilkan untuk pembayaran (full atau DP)
            let valueText = '';
            if (paymentType === 'full') {
                // Cek apakah totalPrice ada dan valid, jika tidak gunakan 0
                valueText = totalPrice ? `Rp ${parseInt(totalPrice).toLocaleString('id-ID')}` : 'Rp 0';
            } else if (paymentType === 'dp') {
                // Cek apakah dpAmount ada dan valid, jika tidak gunakan 0
                valueText = dpAmount ? `DP: Rp ${parseInt(dpAmount).toLocaleString('id-ID')}` : 'DP: Rp 0';
            }
            // Ganti teks placeholder dengan data yang sesuai
            detail.querySelector('.payment-method').innerText = methodText;
            detail.querySelector('.payment-value').innerText = valueText;
        });
    });

    // Fungsi untuk membuka lightbox dan menampilkan gambar
function openLightbox(imageSrc) {
    var lightbox = document.getElementById('lightboxModal');
    var lightboxImage = document.getElementById('lightboxImage');
    
    lightbox.style.display = 'flex';  // Tampilkan lightbox
    lightboxImage.src = imageSrc;    // Set gambar di lightbox
}

// Fungsi untuk menutup lightbox
function closeLightbox() {
    var lightbox = document.getElementById('lightboxModal');
    lightbox.style.display = 'none';  // Sembunyikan lightbox
}


</script>

@endsection
@can('isCustomer', Auth::user())
<!-- Modal -->
<div class="modal fade" id="ulasanForm" tabindex="-1" aria-labelledby="ulasanFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #ffe6e6;">
            <div class="modal-header">
                <h5 class="modal-title" id="ulasanFormLabel" style="color: #cc6699;">Beri Ulasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ratingFormContent" method="POST" action="{{ route('rating.store') }}">
                @csrf
                <div class="modal-body">

                    @if(isset($order))
                    <input type="hidden" name="muatype_id" id="muatype_id" value="{{ $order->muatype_id }}">
                    @else
                        console.error("Order data is not available.");
                    @endif
                
                    
                    <input type="hidden" name="order_id" id="order_id">
                    <input type="hidden" name="admin_id" id="admin_id" >
                    <input type="hidden" name="customer_id" value="{{ Auth::user()->customer->id }}">

                    

                    <div class="row">
                        <!-- Rating dan Ulasan untuk Muatype -->
                        <div class="col-md-6">
                            <h6 style="color: #cc6699;">Ulasan untuk Muatype</h6>
                            <div class="star-rating">
                                <input type="radio" id="muatype-star5" name="muatype_rating" value="5" />
                                <label for="muatype-star5">&#9733;</label>
                                <input type="radio" id="muatype-star4" name="muatype_rating" value="4" />
                                <label for="muatype-star4">&#9733;</label>
                                <input type="radio" id="muatype-star3" name="muatype_rating" value="3" />
                                <label for="muatype-star3">&#9733;</label>
                                <input type="radio" id="muatype-star2" name="muatype_rating" value="2" />
                                <label for="muatype-star2">&#9733;</label>
                                <input type="radio" id="muatype-star1" name="muatype_rating" value="1" />
                                <label for="muatype-star1">&#9733;</label>
                            </div>
                            <textarea class="form-control mt-2" name="muatype_ulasan" placeholder="Tulis ulasan Anda untuk Muatype..."></textarea>
                        </div>
                        
                        <!-- Rating dan Ulasan untuk Admin -->
                        <div class="col-md-6">
                            <h6 style="color: #cc6699;">Ulasan untuk Admin</h6>
                            <div class="star-rating">
                                <input type="radio" id="admin-star5" name="admin_rating" value="5" />
                                <label for="admin-star5">&#9733;</label>
                                <input type="radio" id="admin-star4" name="admin_rating" value="4" />
                                <label for="admin-star4">&#9733;</label>
                                <input type="radio" id="admin-star3" name="admin_rating" value="3" />
                                <label for="admin-star3">&#9733;</label>
                                <input type="radio" id="admin-star2" name="admin_rating" value="2" />
                                <label for="admin-star2">&#9733;</label>
                                <input type="radio" id="admin-star1" name="admin_rating" value="1" />
                                <label for="admin-star1">&#9733;</label>
                            </div>
                            <textarea class="form-control mt-2" name="admin_ulasan" placeholder="Tulis ulasan Anda untuk Admin..."></textarea>
                        </div>
                    </div>
                
                 </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn" style="background-color: #cc6699; color: white;">Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--  MODAL UPDATE ORDER  -->

<div class="modal fade" id="updateOrderForm" tabindex="-1" aria-labelledby="updateOrderFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateOrderFormLabel">Edit Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @if(isset($order))
                <form id="updateOrderFormContent" method="POST" action="/order/{{ $order->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="hidden-price-per-hour" name="price_per_hour" value="">

                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Tanggal Booking</label>
                        <input type="date" class="form-control" name="booking_date" id="modal-booking_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="start_time" class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-control" name="start_time" id="modal-start_time" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_time" class="form-label">Waktu Selesai</label>
                        <input type="time" class="form-control" name="end_time" id="modal-end_time" required>
                    </div>

                    <div class="mb-3">
                        <label for="total_price" class="form-label">Total Harga</label>
                        <input type="number" class="form-control" name="total_price" id="modal-total_price" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="dp" class="form-label">DP (Down Payment)</label>
                        <input type="number" class="form-control" name="dp" id="modal-dp" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                </form>
                @else
                        console.error("Order data is not available.");
                @endif
                
            </div>
        </div>
    </div>
</div>

<!-- PAYEMNT MODAL -->

<div class="modal fade" id="PaymentForm" tabindex="-1" aria-labelledby="PaymentFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('payment.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="order_id" id="order-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="PaymentFormLabel">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Pilihan Metode Pembayaran -->
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Metode Pembayaran</label>
                        <select class="form-select" id="payment-method" name="payment_method" required>
                            <option value="bank_bri">Bank BRI</option>
                            <option value="bank_nagari">Bank Nagari</option>
                            <option value="dana">Dana</option>
                            <option value="gopay">GoPay</option>
                        </select>
                    </div>

                    <!-- Pilihan Jenis Pembayaran -->
                    <div class="mb-3">
                        <label for="payment_type" class="form-label">Jenis Pembayaran</label>
                        <select class="form-select" id="payment-type" name="payment_type" required>
                            <option value="dp">Bayar DP (Down Payment)</option>
                            <option value="full">Bayar Penuh</option>
                        </select>
                    </div>

                    <!-- Informasi Pembayaran -->
                    <div class="mb-3">
                        <label for="payment_info" class="form-label">Informasi Pembayaran</label>
                        <textarea class="form-control" id="payment-info" readonly></textarea>
                    </div>

                    <!-- Total yang Harus Dibayar -->
                    <div class="mb-3">
                        <label for="total_payment" class="form-label">Jumlah yang Harus Dibayar</label>
                        <input type="text" class="form-control" id="total-payment" name="total_payment" readonly>
                    </div>

                    <!-- Upload Bukti Pembayaran -->
                    <div class="mb-3">
                        <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" class="form-control" name="payment_proof" id="payment-proof" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endcan


<!-- Modal Payemnt Pemding -->
<div class="modal fade" id="bayarForm" tabindex="-1" aria-labelledby="bayarFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bayarFormLabel">Detail Pembayaran Pending</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Metode Pembayaran</th>
                            <th>Jenis Pembayaran</th>
                            <th>Total Pembayaran</th>
                            <th>Bukti Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($pendingPayments->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada pembayaran pending.</td>
                            </tr>
                        @else
                            @foreach($pendingPayments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->order->customer->user->name }}</td>
                                    <td class="payment-detail" 
                                        data-payment-method="{{ $payment->payment_method }}" 
                                        data-payment-type="{{ $payment->payment_type }}"
                                        data-total-price="{{ $payment->order->total_price }}"
                                        data-dp-amount="{{ $payment->order->dp }}">
                                        <span class="payment-method">Loading...</span>
                                    </td>
                                    <td>{{ $payment->payment_type }}</td>
                                    <td>
                                        @if($payment->payment_type === 'full')
                                            Rp {{ number_format($payment->order->total_price, 0, ',', '.') }}
                                        @elseif($payment->payment_type === 'dp')
                                            DP: Rp {{ number_format($payment->order->dp, 0, ',', '.') }}
                                        @else
                                            Tidak Ada Pembayaran
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $payment->payment_proof) }}" 
                                             alt="Bukti Pembayaran" class="img-thumbnail" style="max-width: 100px;" 
                                             onclick="openLightbox('{{ asset('storage/' . $payment->payment_proof) }}')">
                                    </td>
                                    
                                    <!-- Modal untuk menampilkan gambar fullscreen -->
                                    <div id="lightboxModal" class="lightbox" onclick="closeLightbox()">
                                        <span id="closeBtn" onclick="closeLightbox()">X</span>
                                        <img id="lightboxImage" class="lightbox-content" />
                                    </div>

                                    <style>/* CSS untuk Lightbox */
                                        .lightbox {
                                            display: none;
                                            position: fixed;
                                            z-index: 1000;
                                            left: 0;
                                            top: 0;
                                            width: 100%;
                                            height: 100%;
                                            background-color: rgba(0, 0, 0, 0.8);
                                            justify-content: center;
                                            align-items: center;
                                            cursor: pointer;
                                        }
                                        
                                        .lightbox-content {
                                            max-width: 90%;
                                            max-height: 90%;
                                        }
                                        
                                        #closeBtn {
                                            position: absolute;
                                            top: 10px;
                                            right: 20px;
                                            font-size: 30px;
                                            color: white;
                                            cursor: pointer;
                                        }
                                        </style>
                                    
                                    <td>
                                        <form action="{{ route('payment.update', $payment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT') <!-- Menambahkan metode PUT di sini -->
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="btn btn-success btn-sm">Konfirmasi</button>
                                        </form>
                                        <form action="{{ route('payment.update', $payment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT') <!-- Menambahkan metode PUT di sini -->
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk menampilkan gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel">Bukti Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="" id="modalImage" class="img-fluid" alt="Bukti Pembayaran">
        </div>
      </div>
    </div>
  </div>
  