<div>

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
        <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
</div>