
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
    {{-- <div class="order">
        <div class="head">
            <h3>Recent Orders</h3>
            <a href="/dashboard-muatype/create" class="btn btn-primary mb-3">Tambah MUA Type</a>
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
        </div> --}}
        <div class="containerprofile">
            <div class="profile-sidebar">
                <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('/img/no-photo.png') }}" alt="Profile Picture" class="profile-pic">

                <h2>{{ Auth::user()->name ? Auth::user()->name : 'Nama tidak tersedia' }}</h2>
                <p>{{ Auth::user()->email ? Auth::user()->email : 'Nama tidak tersedia' }}</p>
            </div>
            <div class="profile-content">
                <h2>Profile Details</h2>
                <div class="profile-details">
                        @php
                            $nameParts = explode(' ', Auth::user()->name, 2);
                            $firstName = $nameParts[0];
                            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
                        @endphp
                    <p><strong>Name:</strong> {{ $firstName }}</p>
                    <p><strong>Surname:</strong> {{ $lastName ? $lastName : 'Last Name Tidak adas' }}</p>
                    <p><strong>Mobile Number:</strong> {{ Auth::user()->phone_number ? Auth::user()->phone_number : 'Phone Number tidak tersedia' }}</p>
                    <p><strong>Address Line:</strong> {{ Auth::user()->address ? Auth::user()->address : 'Alamat  tidak tersedia' }}</p>
                    <p><strong>Email ID:</strong> {{ Auth::user()->email ? Auth::user()->email : 'Nama tidak tersedia' }}</p>
                    <p><strong>Spesialisasi:</strong> 
                        @if(Auth::user()->admin && Auth::user()->admin->muatypes->isNotEmpty())
                            @foreach(Auth::user()->admin->muatypes as $muatype)
                                {{ $muatype->nama_mua }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            Tidak ada spesialisasi
                        @endif
                        </p>

                    @if(Auth::check())
    <p>User ID: {{ Auth::id() }}</p>
    <p>Admin: {{ Auth::user()->admin ? 'Ada' : 'Tidak ada' }}</p>
    
@endif
                    
                </div>
            </div>
            <div class="experience-content">
                <a href="/galery" class="btn btn-primary mb-3">Tambah Galery</a>
                <a href="/profile/{{ Auth::user()->id }}/edit" class="btn btn-primary mb-3">Edit Profile</a>
                
            </div>
        </div>
    {{-- </div> --}}
</div>

{{ $muatypes->links() }}
@endsection
