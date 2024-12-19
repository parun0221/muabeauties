


@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1> WELCOME {{ Auth::user()->name }} You Are {{ Auth::user()->role }} </h1>
<div class="admin-reviews-container">
    <h1 class="reviews-title">Ulasan untuk {{ $admin->user->name }} <br> {{ $admin->average_rating}}/5</h1>
    <div class="reviews-list">
        @forelse ($ratings as $rating)
        <div class="review-card">
            <div class="review-header">
                <img src="{{ $rating->customer->user->profile_photo ? asset('storage/' . $rating->customer->user->profile_photo) : asset('/img/no-photo.png') }}" 
                     alt="Foto {{ $rating->customer->user->name }}" 
                     class="review-avatar">
                <div class="review-info">
                    <h3 class="review-user-name">{{ $rating->customer->user->name }}</h3>
                    <p class="review-date">{{ $rating->created_at->format('d M Y') }}</p>
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
        </div>
        @empty
        <p class="no-reviews">Belum ada ulasan untuk admin ini.</p>
        @endforelse
    </div>
</div>



@endsection
