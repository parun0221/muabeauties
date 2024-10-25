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
        <img src="/img/babang.jpg" alt="Profile Image">
        
    </a>
    <div class="profile-bar-menu" id="profile-bar-menu">
        <div class="contact-bar-card">
            <div class="card-bar-header">
                <!-- Replace with your actual profile image URL -->
                <img src="/img/babang.jpg" alt="Profile Image" class="profile-bar-img">
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
                <a href="" class="btn-edit-profile"><i class="fa fa-user"></i> Edit Profil</a>
                <a href="" class="btn-change-password"><i class="fa fa-key"></i> Ubah Password</a>
            </div>
            
        </div>
    </div>
</nav>
