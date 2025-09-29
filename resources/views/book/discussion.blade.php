@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/book/discussion.css') }}">
@endsection

@section('title', 'Discussion - MyBooking')
@section('page-title', 'Discussion')

@section('content')
    <div class="inner-container">

        <h2 class="inner-title">Book Discussion Room</h2>
        <p class="inner-subtitle">Choose your preferred room</p>

        <div class="discussion-grid">
            @foreach ($discussionRooms as $room)
                <a href="{{ route('discussion.show', $room['number']) }}" class="discussion-link" title="Book Discussion {{ $room['number'] }}">
                    <div class="discussion-card">
                        <div class="discussion-image" style="background-image: url('https://picsum.photos/400/300')">
                            <div class="discussion-overlay">
                                <span class="room-number">{{ $room['number'] }}</span>
                                <span class="room-floor">{{ $room['floor'] }} Floor</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

@endsection
