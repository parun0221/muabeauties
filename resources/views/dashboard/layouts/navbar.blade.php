<nav>
    <i class='bx bx-menu'></i>
    <a href="#" class="nav-link">Categories</a>

    <!-- Center Profile Section -->
    <div class="center">
        {{-- <a href="#" class="profile" id="profile-btn">
            <img src="/img/babang.jpg">
        </a>
        <div class="dropdown-menu" id="profile-menu">
            <ul>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div> --}}
    </div>

    <!-- Search Box (Right-Aligned) -->
    <form action="/search" method="GET" class="search-form">
        <div class="form-input">
            <input type="search" name="query" placeholder="Search..." id="search-input">
            <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        </div>
    </form>

    <!-- Mode Switcher -->
    <input type="checkbox" id="switch-mode" hidden>
    <label for="switch-mode" class="switch-mode"></label>

    <!-- Notifications -->
    <a href="#" class="notification">
        <i class='bx bxs-bell'></i>
        <span class="num">8</span>
    </a>
    <a href="#" class="profile dropdown-bar-toggle" id="profile-bar-btn">
        <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('/img/no-photo.png') }}" alt="Profile Image">
        
    </a>
    <div class="profile-bar-menu" id="profile-bar-menu">
        <div class="contact-bar-card">
            <div class="card-bar-header">
                <!-- Replace with your actual profile image URL -->
                <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('/img/no-photo.png') }}" alt="Profile Image" class="profile-bar-img">
                <div class="card-bar-info">
                    <h2>{{ Auth::user()->name }}</h2>
                    <p>{{ Auth::user()->role }}</p>
                </div>
            </div>
            
            <div class="card-bar-details">
                <p><i class="fa fa-phone"></i> (581)-307-6902</p>
                {{-- @can('isAdmin', Auth::user()) --}}
                     <p><i class="fa fa-envelope"></i> {{ Auth::user()->email ? Auth::user()->email : 'Email tidak tersedia' }}</p>
                
    
                {{-- @can('isCustomer', Auth::user()) --}}
                     <p><i class="fa fa-envelope"></i> {{ Auth::user()->address ? Auth::user()->address : 'Alamat tidak tersedia' }}</p>
                
            </div>

            <div class="card-bar-actions">
                <a href="/profile" class="btn-edit-profile"><i class="fa fa-user"></i> Edit Profil</a>
                <a href="" class="btn-change-password" data-bs-toggle="modal" data-bs-target="#passwordForm"><i class="fa fa-key"></i> Ubah Password</a>
            </div>
            
        </div>
    </div>


    
    
    


</nav><div class="modal fade" id="passwordForm" tabindex="-1" aria-labelledby="passwordFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordFormLabel">Ganti Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="passwordChangeForm" method="POST" action="/user/newpassword">
                    @csrf
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Password Sekarang</label>
                        <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                        <div id="currentPasswordError" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="confirmPassword" name="new_password_confirmation" required>
                        <div id="confirmPasswordError" class="invalid-feedback"></div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#passwordChangeForm').on('submit', function (e) {
            e.preventDefault();
            
            console.log("Form submitted via AJAX"); // Debug log untuk cek preventDefault

            // Reset feedback
            $('#currentPasswordError').text('');
            $('#confirmPasswordError').text('');
            $('#currentPassword').removeClass('is-invalid');
            $('#confirmPassword').removeClass('is-invalid');

            $.ajax({
                url: "/user/newpassword",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    // Tampilkan pesan sukses, bisa disesuaikan dengan kebutuhan
                    alert("Password berhasil diperbarui");
                    $('#passwordForm').modal('hide');
                },
                error: function (xhr) {
                    // Tangani error validasi
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.current_password) {
                            $('#currentPasswordError').text(errors.current_password[0]);
                            $('#currentPassword').addClass('is-invalid');
                        }
                        if (errors.new_password) {
                            $('#confirmPasswordError').text(errors.new_password[0]);
                            $('#confirmPassword').addClass('is-invalid');
                        }
                    }
                }
            });
        });
    });
</script>
