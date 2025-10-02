@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/book/class.css') }}">
@endsection

@section('title', 'Classroom - MyBooking')
@section('page-title', 'Classroom')

@section('content')
    <div class="inner-container">

        <h2 class="inner-title">Book Classroom</h2>
        <p class="inner-subtitle">Choose your preferred room</p>

        <div class="discussion-grid">
            @foreach ($floors as $floor)
                <a href="{{ route('class.show', $floor->floor_number) }}" class="discussion-link" title="Book Classroom {{ $floor->floor_number }}">
                    <div class="discussion-card">
                        <div class="discussion-image" style="background-image: url('{{ asset('images/Class.jpg') }}');">
                            <div class="discussion-overlay">
                                <span class="room-floor">Floor {{ $floor->floor_number }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

@endsection
