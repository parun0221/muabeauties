
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
            <a href="/dashboard-muatype/create" class="btn btn-primary mb-3">Tambah MUA Type</a>
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
        </div>
        <form action="/profile/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="phone_number">Mobile Number:</label>
                <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="form-control">
            </div>
        
            <div class="form-group">
                <label for="address">Address Line:</label>
                <input type="text" name="address" value="{{ $user->address }}" class="form-control">
            </div>
        
            <div class="form-group">
                <label for="profile_photo">Profile Photo:</label>
                <input type="file" name="profile_photo" class="form-control">
            </div>
        
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>

@endsection
