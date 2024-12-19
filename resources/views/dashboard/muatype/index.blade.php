
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

{{-- <ul class="box-info">
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach($muatypes as $muatype)
                <tr>
                        <td>{{ $muatype->nama_mua }}</td>
                        <td>{{ $muatype->deskripsi }}</td>
                        <td>Rp. {{ $muatype->harga_per_jam }}</td>

    <!-- Menampilkan gambar -->
                        <td>
                     @if($muatype->gambar)
                        <img src="{{ asset('storage/' . $muatype->gambar) }}" alt="{{ $muatype->nama_mua }}" width="2000">
                    @endif
                        </td>
                        <td>
                            <!-- Link Edit -->
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateMuatypeForm" data-muatype-id="{{ $muatype->id }}">
                                Edit
                            </a>
                        
                            <!-- Link Hapus -->
                            
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteMuatype({{ $muatype->id }})">
                                Hapus
                            </a>
                            
                            <script>
                                function deleteMuatype(id) {
                                if (confirm('Apakah anda yakin ingin menghapus?')) {
                                    fetch(`/dashboard-muatype/${id}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log('Response data:', data); // Tambahkan log untuk memastikan respons benar
                                        if (data.success) {
                                            alert('Data berhasil dihapus');
                                            location.reload(); // Memuat ulang halaman setelah berhasil menghapus
                                        } else {
                                            alert('Gagal menghapus data');
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                                }
                            }

                            </script>
                            
                            
                            
                        </td>
                </tr>
                @endforeach

                 
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>

{{ $muatypes->links() }}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Event listener saat modal ditampilkan
        const updateModal = document.getElementById('updateMuatypeForm');
        updateModal.addEventListener('show.bs.modal', function (event) {
            // Tombol yang memicu modal
            const button = event.relatedTarget;

            // Ambil ID dari atribut data pada tombol
            const muatypeId = button.getAttribute('data-muatype-id');

            // Update form action URL di modal
            const form = updateModal.querySelector('form');
            form.action = `/dashboard-muatype/${muatypeId}`;

            // Lakukan fetch data dari server atau ambil data secara lokal
            fetch(`/dashboard-muatype/${muatypeId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Isi nilai form dengan data yang diterima
                    document.getElementById('modal-nama_mua').value = data.nama_mua;
                    document.getElementById('modal-deskripsi').value = data.deskripsi;
                    document.getElementById('modal-harga_per_jam').value = data.harga_per_jam;

                    // Perbarui gambar jika ada
                    const gambarPreview = document.querySelector('#modal-gambar-preview');
                    if (data.gambar) {
                        gambarPreview.src = `/storage/${data.gambar}`;
                        gambarPreview.style.display = 'block';
                    } else {
                        gambarPreview.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    });
</script>


@endsection

<div class="modal fade" id="updateMuatypeForm" tabindex="-1" aria-labelledby="updateMuatypeFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateMuatypeFormLabel">Update MUA Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @if(isset($muatype))
                <form id="updateMuatypeFormContent" method="POST" action="/dashboard-muatype/{{ $muatype->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="modal-nama_mua" class="form-label">Nama MUA</label>
                        <input type="text" class="form-control" name="nama_mua" id="modal-nama_mua" required maxlength="255">
                    </div>
                    <div class="mb-3">
                        <label for="modal-deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="modal-deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="modal-harga_per_jam" class="form-label">Harga per Jam</label>
                        <input type="number" class="form-control" name="harga_per_jam" id="modal-harga_per_jam" required>
                    </div>
                    <div class="mb-3">
                        <label for="modal-gambar" class="form-label">Upload Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="modal-gambar" accept="image/*">
                        <div class="mt-2">
                            <img id="modal-gambar-preview" class="img-thumbnail" width="100" style="display:none;">
                        </div>
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
