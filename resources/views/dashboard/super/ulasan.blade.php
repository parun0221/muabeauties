@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1> WELCOME {{ Auth::user()->name }} You Are {{ Auth::user()->role }} </h1>

<div class="filter-review-container">
    <form method="GET" action="/ratings">
        <input type="text" name="search" placeholder="Cari Ulasan..." value="{{ request('search') }}">
        <select name="rating" onchange="this.form.submit()">
            <option value="">Filter Rating</option>
            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Bintang</option>
            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Bintang</option>
            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Bintang</option>
            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Bintang</option>
            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Bintang</option>
        </select>
    </form>
</div>

<div class="admin-reviews-container">
    <div class="reviews-list">
        @forelse ($ratings as $rating)
        <div class="review-card">
            <div class="review-header">
                <!-- Profil Customer -->
                <div class="review-avatar-container customer">
                    <img src="{{ $rating->customer->user->profile_photo ? asset('storage/' . $rating->customer->user->profile_photo) : asset('/img/no-photo.png') }}" 
                         alt="Foto {{ $rating->customer->user->name }}" 
                         class="review-avatar">
                    <div class="review-info">
                        <h3 class="review-user-name">{{ $rating->customer->user->name }}</h3>
                        <p class="review-date">{{ $rating->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <!-- Profil Admin -->
                <div class="review-avatar-container admin">
                    <img src="{{ $rating->admin->user->profile_photo ? asset('storage/' . $rating->admin->user->profile_photo) : asset('/img/no-photo.png') }}" 
                         alt="Foto {{ $rating->admin->user->name }}" 
                         class="review-avatar">
                    <div class="review-info">
                        <h3 class="review-user-name">{{ $rating->admin->user->name }}</h3>
                        <p class="review-date">{{ $rating->admin->user->role }}</p>
                    </div>
                </div>
            </div>

            <div class="review-body">
                <div class="review-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="star {{ $i <= $rating->rating ? 'filled' : '' }}"></i>
                    @endfor
                </div>
                <p class="review-comment">“{{ $rating->review }}”</p>
            </div>

            <div class="review-action">
                <a href="#" class="btn-sensor">Sensor Review</a>
            </div>
        </div>
        @empty
        <p class="no-reviews">Belum ada ulasan untuk admin ini.</p>
        @endforelse
    </div>
</div>

@endsection
